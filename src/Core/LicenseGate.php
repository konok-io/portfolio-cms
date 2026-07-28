<?php

declare(strict_types=1);

namespace Mrh\License\Core;

use Mrh\License\Enums\LicenseStatus;
use Mrh\License\Services\GracePeriodService;
use Mrh\License\Repositories\Contracts\LicenseRepositoryInterface;

/**
 * Hot-path read guard. Reads local license state and applies status +
 * grace math to decide allow / block. Never performs network I/O.
 *
 * This is an alternate, dependency-light entry the host app can use directly
 * (e.g. in a Blade @if) alongside the global EnsureLicenseValid middleware.
 */
class LicenseGate
{
    public function __construct(
        private readonly LicenseRepositoryInterface $licenses,
        private readonly GracePeriodService $grace,
    ) {
    }

    /** Whether the application is currently permitted to run. */
    public function allows(): bool
    {
        $setting = $this->licenses->current();

        if ($setting === null) {
            return false; // never activated
        }

        $status = LicenseStatus::tryFrom((string) $setting->status) ?? LicenseStatus::Pending;

        // Active is always allowed. Grace is allowed while inside the window.
        if ($status === LicenseStatus::Active) {
            return true;
        }

        if ($status === LicenseStatus::Grace) {
            return $this->grace->isWithinGrace($setting);
        }

        return false;
    }

    /** Whether the stored verdict is stale and requires re-verification. */
    public function isStale(): bool
    {
        $setting = $this->licenses->current();

        if ($setting === null) {
            return true;
        }

        return ! $this->grace->isVerdictFresh($setting);
    }
}
