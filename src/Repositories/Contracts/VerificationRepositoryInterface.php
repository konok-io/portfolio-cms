<?php

declare(strict_types=1);

namespace Mrh\License\Repositories\Contracts;

use Illuminate\Support\Collection;
use Mrh\License\Models\LicenseSetting;
use Mrh\License\Models\LicenseVerification;

/**
 * Persistence boundary for the rolling history of signed verification
 * verdicts. Insert-only; supports "latest verdict" reads and time-based
 * pruning.
 */
interface VerificationRepositoryInterface
{
    /** Record a received verdict. */
    public function record(array $attributes): LicenseVerification;

    /** The most recent verdict for a setting, if any. */
    public function latestFor(LicenseSetting $setting): ?LicenseVerification;

    /** Recent verdicts, newest first, limited. */
    public function recentFor(LicenseSetting $setting, int $limit = 20): Collection;

    /** True if a nonce has already been recorded (replay guard). */
    public function nonceExists(string $nonce): bool;

    /** Delete verdicts older than the given number of days; returns count. */
    public function pruneOlderThan(int $days): int;
}
