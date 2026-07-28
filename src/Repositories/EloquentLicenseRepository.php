<?php

declare(strict_types=1);

namespace Mrh\License\Repositories;

use Mrh\License\Models\LicenseSetting;
use Mrh\License\Repositories\Contracts\LicenseRepositoryInterface;

/**
 * Eloquent-backed local license state repository.
 *
 * Owns the single-row state model. Callers pass already-encrypted key
 * material (encryption is the store/service layer's job) so this repository
 * stays a thin, testable persistence boundary.
 */
class EloquentLicenseRepository implements LicenseRepositoryInterface
{
    public function current(): ?LicenseSetting
    {
        return LicenseSetting::query()->latest('id')->first();
    }

    public function findByInstallationId(string $installationId): ?LicenseSetting
    {
        return LicenseSetting::query()
            ->where('installation_id', $installationId)
            ->first();
    }

    public function updateOrCreate(string $installationId, array $attributes): LicenseSetting
    {
        return LicenseSetting::query()->updateOrCreate(
            ['installation_id' => $installationId],
            $attributes,
        );
    }

    public function update(LicenseSetting $setting, array $attributes): LicenseSetting
    {
        $setting->fill($attributes)->save();

        return $setting->refresh();
    }

    public function saveVerdict(LicenseSetting $setting, array $verdict, string $signature): LicenseSetting
    {
        $setting->fill([
            'last_verdict'     => $verdict,
            'last_signature'   => $signature,
            'last_action'      => $verdict['action']   ?? $setting->last_action,
            'key_version'      => $verdict['key_version'] ?? $setting->key_version,
            'expires_at'       => $verdict['expires_at'] ?? $setting->expires_at,
            'next_verify_by'   => $verdict['next_verify_by'] ?? $setting->next_verify_by,
            'last_verified_at' => now(),
        ])->save();

        return $setting->refresh();
    }

    public function markStatus(LicenseSetting $setting, string $status): LicenseSetting
    {
        $setting->forceFill(['status' => $status])->save();

        return $setting->refresh();
    }

    public function clear(): void
    {
        // Cascades to activations + verifications; logs are nullOnDelete.
        LicenseSetting::query()->delete();
    }
}
