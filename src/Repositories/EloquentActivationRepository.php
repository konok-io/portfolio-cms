<?php

declare(strict_types=1);

namespace Mrh\License\Repositories;

use Illuminate\Support\Collection;
use Mrh\License\Models\LicenseActivation;
use Mrh\License\Models\LicenseSetting;
use Mrh\License\Repositories\Contracts\ActivationRepositoryInterface;

/**
 * Eloquent-backed activation repository.
 */
class EloquentActivationRepository implements ActivationRepositoryInterface
{
    public function create(array $attributes): LicenseActivation
    {
        return LicenseActivation::query()->create($attributes);
    }

    public function update(LicenseActivation $activation, array $attributes): LicenseActivation
    {
        $activation->fill($attributes)->save();

        return $activation->refresh();
    }

    public function activeFor(LicenseSetting $setting): ?LicenseActivation
    {
        return $setting->activations()
            ->where('status', 'active')
            ->latest('id')
            ->first();
    }

    public function findByInstallation(LicenseSetting $setting, string $installationId): ?LicenseActivation
    {
        return $setting->activations()
            ->where('installation_id', $installationId)
            ->first();
    }

    public function historyFor(LicenseSetting $setting): Collection
    {
        return $setting->activations()
            ->latest('id')
            ->get();
    }

    public function revoke(LicenseActivation $activation): LicenseActivation
    {
        $activation->forceFill([
            'status'     => 'revoked',
            'revoked_at' => now(),
        ])->save();

        return $activation->refresh();
    }

    public function supersedeActive(LicenseSetting $setting): int
    {
        return $setting->activations()
            ->where('status', 'active')
            ->update([
                'status'     => 'superseded',
                'revoked_at' => now(),
            ]);
    }
}
