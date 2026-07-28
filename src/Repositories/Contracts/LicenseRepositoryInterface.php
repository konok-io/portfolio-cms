<?php

declare(strict_types=1);

namespace Mrh\License\Repositories\Contracts;

use Mrh\License\Models\LicenseSetting;

/**
 * Persistence boundary for the single-row local license state.
 * The rest of the package depends on this interface, never on Eloquent
 * directly, so the storage layer can be swapped or mocked in tests.
 */
interface LicenseRepositoryInterface
{
    /** The current (single) license state row, or null before activation. */
    public function current(): ?LicenseSetting;

    /** Fetch by the stable installation identifier. */
    public function findByInstallationId(string $installationId): ?LicenseSetting;

    /** Create or update the state row keyed by installation_id. */
    public function updateOrCreate(string $installationId, array $attributes): LicenseSetting;

    /** Persist arbitrary attributes onto the current row. */
    public function update(LicenseSetting $setting, array $attributes): LicenseSetting;

    /** Persist the latest signed verdict + denormalized status fields. */
    public function saveVerdict(LicenseSetting $setting, array $verdict, string $signature): LicenseSetting;

    /** Flip the denormalized status (active|grace|expired|blocked|pending). */
    public function markStatus(LicenseSetting $setting, string $status): LicenseSetting;

    /** Remove all local license state (used by reset). */
    public function clear(): void;
}
