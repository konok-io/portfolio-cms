<?php

declare(strict_types=1);

namespace Mrh\License\Repositories\Contracts;

use Illuminate\Support\Collection;
use Mrh\License\Models\LicenseActivation;
use Mrh\License\Models\LicenseSetting;

/**
 * Persistence boundary for local activation records (the signed grants
 * received from the server and their lifecycle on this client).
 */
interface ActivationRepositoryInterface
{
    /** Create an activation record. */
    public function create(array $attributes): LicenseActivation;

    /** Update an existing activation record (used on re-activation). */
    public function update(LicenseActivation $activation, array $attributes): LicenseActivation;

    /** The active binding for a setting, if any. */
    public function activeFor(LicenseSetting $setting): ?LicenseActivation;

    /** Find a binding by installation id within a setting. */
    public function findByInstallation(LicenseSetting $setting, string $installationId): ?LicenseActivation;

    /** All activations for a setting, newest first. */
    public function historyFor(LicenseSetting $setting): Collection;

    /** Mark a binding revoked (e.g. after a kill verdict or reset). */
    public function revoke(LicenseActivation $activation): LicenseActivation;

    /** Mark any existing active bindings as superseded before a new one. */
    public function supersedeActive(LicenseSetting $setting): int;
}
