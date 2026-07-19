<?php

declare(strict_types=1);

namespace Mrh\License\Cache;

use Illuminate\Contracts\Cache\Repository as CacheRepository;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Support\Carbon;
use Mrh\License\Models\LicenseSetting;
use Mrh\License\Repositories\Contracts\LicenseRepositoryInterface;

/**
 * VerificationCache
 * -----------------
 * The 24-hour verification window gate. Answers one question the verify flow
 * asks on every run:
 *
 *     "Was this installation verified within the window? If so, skip the
 *      server call. If not, we must verify with the license server."
 *
 * Decision source of truth is `license_settings.last_verified_at`. A fast
 * cache key mirrors that timestamp so the common "still fresh" path never
 * touches the database; the DB is the durable fallback when the cache is
 * cold (e.g. after a cache flush or on shared hosting).
 *
 * Pure decision + timestamp bookkeeping — no network, no signature logic.
 */
class VerificationCache
{
    /** Cache key holding the last successful verification timestamp (ISO-8601). */
    private const KEY = 'mrh_license:last_verified_at';

    public function __construct(
        private readonly CacheRepository $cache,
        private readonly Config $config,
        private readonly LicenseRepositoryInterface $licenses,
    ) {
    }

    /** The configured verification window in hours (default 24). */
    public function windowHours(): int
    {
        return (int) $this->config->get('mrh-license.cache_ttl_hours', 24);
    }

    /**
     * Core rule: TRUE when the last verification is within the 24-hour window
     * (caller should SKIP the server call), FALSE when it is stale or missing
     * (caller MUST verify with the server).
     */
    public function isFresh(?Carbon $now = null): bool
    {
        $now  = $now ?? now();
        $last = $this->lastVerifiedAt();

        if ($last === null) {
            return false; // never verified → must verify
        }

        return $last->copy()->addHours($this->windowHours())->greaterThanOrEqualTo($now);
    }

    /** Inverse of isFresh(): does the caller need to call the server? */
    public function needsVerification(?Carbon $now = null): bool
    {
        return ! $this->isFresh($now);
    }

    /**
     * The last successful verification time. Prefers the fast cache mirror,
     * falls back to the persisted `last_verified_at`, and back-fills the
     * cache when it was cold.
     */
    public function lastVerifiedAt(): ?Carbon
    {
        // 1. Fast path: cache mirror.
        $cached = $this->cache->get(self::KEY);

        if (is_string($cached) && $cached !== '') {
            return Carbon::parse($cached);
        }

        // 2. Durable fallback: the settings row.
        $setting = $this->licenses->current();
        $stamp   = $setting?->last_verified_at;

        if ($stamp !== null) {
            // Warm the cache for subsequent reads within the window.
            $this->cache->put(self::KEY, $stamp->toIso8601String(), $this->ttlSeconds());
        }

        return $stamp;
    }

    /** Seconds until the current window would expire relative to `$from`. */
    public function secondsRemaining(?Carbon $now = null): int
    {
        $now  = $now ?? now();
        $last = $this->lastVerifiedAt();

        if ($last === null) {
            return 0;
        }

        $expiresAt = $last->copy()->addHours($this->windowHours());

        return $expiresAt->greaterThan($now) ? $now->diffInSeconds($expiresAt) : 0;
    }

    /**
     * Record a successful verification "now" (or at a given time). Updates
     * BOTH the durable timestamp and the cache mirror, so the next call
     * inside the window skips the server. Called after a signed verdict is
     * accepted.
     */
    public function touch(?Carbon $at = null, ?LicenseSetting $setting = null): void
    {
        $at      = $at ?? now();
        $setting = $setting ?? $this->licenses->current();

        if ($setting !== null) {
            $this->licenses->update($setting, ['last_verified_at' => $at]);
        }

        $this->cache->put(self::KEY, $at->toIso8601String(), $this->ttlSeconds());
    }

    /** Invalidate the window, forcing the next check to verify with the server. */
    public function invalidate(): void
    {
        $this->cache->forget(self::KEY);
    }

    /** Cache entry lifetime — the window plus a small cushion. */
    private function ttlSeconds(): int
    {
        return ($this->windowHours() * 3600) + 300;
    }
}
