<?php

declare(strict_types=1);

namespace Mrh\License\Repositories;

use Illuminate\Support\Collection;
use Mrh\License\Models\LicenseSetting;
use Mrh\License\Models\LicenseVerification;
use Mrh\License\Repositories\Contracts\VerificationRepositoryInterface;

/**
 * Eloquent-backed verification history repository. Insert-only.
 */
class EloquentVerificationRepository implements VerificationRepositoryInterface
{
    public function record(array $attributes): LicenseVerification
    {
        return LicenseVerification::query()->create($attributes);
    }

    public function latestFor(LicenseSetting $setting): ?LicenseVerification
    {
        return $setting->verifications()
            ->latest('id')
            ->first();
    }

    public function recentFor(LicenseSetting $setting, int $limit = 20): Collection
    {
        return $setting->verifications()
            ->latest('id')
            ->limit($limit)
            ->get();
    }

    public function nonceExists(string $nonce): bool
    {
        return LicenseVerification::query()
            ->where('nonce', $nonce)
            ->exists();
    }

    public function pruneOlderThan(int $days): int
    {
        return LicenseVerification::query()
            ->where('created_at', '<', now()->subDays($days))
            ->delete();
    }
}
