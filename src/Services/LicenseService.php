<?php

declare(strict_types=1);

namespace Mrh\License\Services;

use Mrh\License\Enums\LicenseStatus;
use Mrh\License\Enums\VerificationAction;
use Mrh\License\Models\LicenseActivation;
use Mrh\License\Repositories\Contracts\ActivationRepositoryInterface;
use Mrh\License\Repositories\Contracts\LicenseRepositoryInterface;
use Mrh\License\Repositories\Contracts\LogRepositoryInterface;
use Mrh\License\Transport\LicenseClient;

/**
 * LicenseService
 * --------------
 * The high-level application service behind the License facade. It composes
 * the focused services (activation, verification, installation, grace) into
 * the four public operations the rest of the app calls: activate, verify,
 * status, reset.
 *
 * This is the ONLY service the host application / commands should need to
 * touch. It delegates all real work — no business rules live here beyond
 * simple composition (SRP + Facade pattern).
 */
class LicenseService
{
    public function __construct(
        private readonly ActivationService $activation,
        private readonly VerificationService $verification,
        private readonly InstallationService $installation,
        private readonly GracePeriodService $grace,
        private readonly LicenseClient $client,
        private readonly LicenseRepositoryInterface $licenses,
        private readonly ActivationRepositoryInterface $activations,
        private readonly LogRepositoryInterface $logs,
    ) {
    }

    /** Bind this installation to its configured license key. */
    public function activate(?string $licenseKey = null): LicenseActivation
    {
        $key = $licenseKey ?? $this->installation->licenseKey() ?? '';

        return $this->activation->activate($key);
    }

    /** Whether this installation is currently bound and active (local check). */
    public function isActivated(): bool
    {
        return $this->activation->isActivated();
    }

    /** Run the signed daily verification heartbeat. */
    public function verify(?string $licenseKey = null): VerificationAction
    {
        $key = $licenseKey ?? $this->installation->licenseKey() ?? '';

        return $this->verification->verify($key);
    }

    /**
     * Verify only if the 24-hour window has elapsed; otherwise skip the
     * server call and return Continue. This is the scheduler-friendly entry.
     */
    public function verifyIfDue(?string $licenseKey = null): VerificationAction
    {
        $key = $licenseKey ?? $this->installation->licenseKey() ?? '';

        return $this->verification->verifyIfDue($key);
    }

    /**
     * Current local status snapshot (no network).
     *
     * @return array<string, mixed>
     */
    public function status(): array
    {
        $setting = $this->licenses->current();

        if ($setting === null) {
            return ['status' => LicenseStatus::Pending->value, 'activated' => false];
        }

        return [
            'status'            => $setting->status,
            'activated'         => $this->activation->isActivated(),
            'installation_id'   => $setting->installation_id,
            'server_type'       => $setting->server_type,
            'normalized_domain' => $setting->normalized_domain,
            'expires_at'        => $setting->expires_at?->toIso8601String(),
            'last_verified_at'  => $setting->last_verified_at?->toIso8601String(),
            'next_verify_by'    => $setting->next_verify_by?->toIso8601String(),
            'grace_ends_at'     => $this->grace->graceEndsAt($setting)?->toIso8601String(),
        ];
    }

    /** Release this installation's binding on the server and clear local state. */
    public function reset(?string $licenseKey = null): void
    {
        $key = $licenseKey ?? $this->installation->licenseKey() ?? '';

        // Best-effort server-side release. Never let a transport failure block
        // the local clear — the installation must always be resettable locally.
        try {
            if ($key !== '') {
                $this->client->reset([
                    'license_key'     => $key,
                    'installation_id' => $this->installation->installationId(),
                    'reason'          => 'client_reset',
                ]);
            }
        } catch (\Throwable $e) {
            $this->logs->error('reset', 'reset.server_unreachable', $e->getMessage());
        }

        $this->licenses->clear();

        $this->logs->info('reset', 'reset.local_cleared', 'Local license state cleared.');
    }
}
