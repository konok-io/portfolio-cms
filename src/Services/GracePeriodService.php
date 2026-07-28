<?php

declare(strict_types=1);

namespace Mrh\License\Services;

use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Support\Carbon;
use Mrh\License\Enums\LicenseStatus;
use Mrh\License\Models\LicenseSetting;
use Mrh\License\Repositories\Contracts\LicenseRepositoryInterface;
use Mrh\License\Repositories\Contracts\LogRepositoryInterface;

/**
 * GracePeriodService
 * ------------------
 * Owns the 7-day grace lifecycle for when the license server is unreachable.
 *
 * Two responsibilities:
 *   1. Decision math (pure): is a verdict still fresh? are we inside grace?
 *   2. Lifecycle actions (stateful): START grace on the first failed contact,
 *      and mark VERIFICATION_FAILED once the window is exceeded.
 *
 * Grace is anchored on grace_ends_at, which is stamped the moment contact is
 * first lost — so the countdown reflects "time since the server went away",
 * independent of license expiry. While inside grace the app keeps running on
 * its last-known-good state; past grace it is blocked.
 */
class GracePeriodService
{
    public function __construct(
        private readonly Config $config,
        private readonly LicenseRepositoryInterface $licenses,
        private readonly LogRepositoryInterface $logs,
    ) {
    }

    /** Configured verification cache window in hours (default 24). */
    public function cacheTtlHours(): int
    {
        return (int) $this->config->get('mrh-license.cache_ttl_hours', 24);
    }

    /** Configured grace window in days (default 7). */
    public function graceDays(): int
    {
        return (int) $this->config->get('mrh-license.grace_days', 7);
    }

    // ---------------------------------------------------------------------
    // Decision math (pure — no writes)
    // ---------------------------------------------------------------------

    /**
     * Is the stored verdict still within its trust window?
     * Prefers the server-provided next_verify_by; falls back to
     * last_verified_at + cache TTL.
     */
    public function isVerdictFresh(LicenseSetting $setting, ?Carbon $now = null): bool
    {
        $now = $now ?? now();

        if ($setting->next_verify_by !== null) {
            return $now->lessThanOrEqualTo($setting->next_verify_by);
        }

        if ($setting->last_verified_at === null) {
            return false;
        }

        return $now->lessThanOrEqualTo(
            $setting->last_verified_at->copy()->addHours($this->cacheTtlHours())
        );
    }

    /**
     * The moment the grace window closes.
     * Once grace has been started, the stamped grace_ends_at is authoritative.
     * Otherwise it is projected from the last successful verification (or
     * license expiry) as a preview of where grace WOULD end.
     */
    public function graceEndsAt(LicenseSetting $setting): ?Carbon
    {
        if ($setting->grace_ends_at !== null) {
            return $setting->grace_ends_at;
        }

        $anchor = $setting->last_verified_at ?? $setting->expires_at;

        return $anchor?->copy()->addDays($this->graceDays());
    }

    /** Are we currently inside the grace window? */
    public function isWithinGrace(LicenseSetting $setting, ?Carbon $now = null): bool
    {
        $ends = $this->graceEndsAt($setting);

        if ($ends === null) {
            return false;
        }

        return ($now ?? now())->lessThanOrEqualTo($ends);
    }

    /** Has the grace window been exceeded? */
    public function isGraceExceeded(LicenseSetting $setting, ?Carbon $now = null): bool
    {
        $ends = $this->graceEndsAt($setting);

        return $ends !== null && ($now ?? now())->greaterThan($ends);
    }

    /** Whether grace has already been started (grace_ends_at stamped). */
    public function graceStarted(LicenseSetting $setting): bool
    {
        return $setting->grace_ends_at !== null;
    }

    /** Whole days left in grace (0 when exceeded/unstarted). */
    public function daysRemaining(LicenseSetting $setting, ?Carbon $now = null): int
    {
        $now  = $now ?? now();
        $ends = $this->graceEndsAt($setting);

        if ($ends === null || $now->greaterThan($ends)) {
            return 0;
        }

        return (int) ceil($now->floatDiffInDays($ends));
    }

    // ---------------------------------------------------------------------
    // Lifecycle actions (stateful — persist changes)
    // ---------------------------------------------------------------------

    /**
     * Called when the license server is unavailable. Starts the grace period
     * on the first failure (idempotent: an already-started grace is left
     * untouched so the clock keeps running from the original failure time).
     *
     * Returns the resolved status: Grace while inside the window,
     * VerificationFailed once exceeded.
     */
    public function handleServerUnavailable(LicenseSetting $setting, ?Carbon $now = null): LicenseStatus
    {
        $now = $now ?? now();

        // Start grace on first failed contact.
        if (! $this->graceStarted($setting)) {
            $endsAt = $now->copy()->addDays($this->graceDays());

            $setting = $this->licenses->update($setting, [
                'grace_ends_at' => $endsAt,
                'status'        => LicenseStatus::Grace->value,
            ]);

            $this->logs->write([
                'channel' => 'verification',
                'event'   => 'grace_started',
                'level'   => 'warning',
                'message' => 'License server unavailable; grace period started.',
                'context' => ['grace_ends_at' => $endsAt->toIso8601String()],
            ]);
        }

        // If the window has now elapsed, fail verification.
        if ($this->isGraceExceeded($setting, $now)) {
            return $this->markVerificationFailed($setting);
        }

        // Still inside grace — keep running.
        if ($setting->status !== LicenseStatus::Grace->value) {
            $setting = $this->licenses->markStatus($setting, LicenseStatus::Grace->value);
        }

        return LicenseStatus::Grace;
    }

    /**
     * Grace exceeded → mark the installation verification_failed. Terminal,
     * non-operational state; the guard blocks on it until a successful
     * verification clears it.
     */
    public function markVerificationFailed(LicenseSetting $setting): LicenseStatus
    {
        if ($setting->status !== LicenseStatus::VerificationFailed->value) {
            $this->licenses->markStatus($setting, LicenseStatus::VerificationFailed->value);

            $this->logs->write([
                'channel' => 'verification',
                'event'   => 'verification_failed',
                'level'   => 'error',
                'message' => 'Grace period exceeded; verification marked as failed.',
                'context' => ['grace_ends_at' => $setting->grace_ends_at?->toIso8601String()],
            ]);
        }

        return LicenseStatus::VerificationFailed;
    }

    /**
     * Called after a SUCCESSFUL verification: clears any active grace so the
     * countdown resets for the next outage.
     */
    public function clearGrace(LicenseSetting $setting): void
    {
        if ($setting->grace_ends_at !== null || $setting->status === LicenseStatus::Grace->value) {
            $this->licenses->update($setting, [
                'grace_ends_at' => null,
                'status'        => LicenseStatus::Active->value,
            ]);
        }
    }
}
