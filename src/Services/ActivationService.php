<?php

declare(strict_types=1);

namespace Mrh\License\Services;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Mrh\License\Enums\LicenseStatus;
use Mrh\License\Exceptions\ActivationFailedException;
use Mrh\License\Exceptions\SignatureVerificationException;
use Mrh\License\Exceptions\TransportException;
use Mrh\License\Models\LicenseActivation;
use Mrh\License\Repositories\Contracts\ActivationRepositoryInterface;
use Mrh\License\Repositories\Contracts\LicenseRepositoryInterface;
use Mrh\License\Repositories\Contracts\LogRepositoryInterface;
use Mrh\License\Transport\LicenseClient;
use Mrh\License\Transport\ResponseVerifier;

/**
 * ActivationService
 * -----------------
 * Orchestrates binding this installation to a license:
 *   1. build identity  2. POST /activate
 *   3. verify the signed grant  4. persist setting + activation.
 *
 * Coordinates collaborators only (SRP); it delegates identity building,
 * signature verification and domain normalization.
 */
class ActivationService
{
    public function __construct(
        private readonly LicenseClient $client,
        private readonly ResponseVerifier $verifier,
        private readonly InstallationService $installation,
        private readonly DomainService $domains,
        private readonly LicenseRepositoryInterface $licenses,
        private readonly ActivationRepositoryInterface $activations,
        private readonly LogRepositoryInterface $logs,
    ) {
    }

    /**
     * Activate this installation. Idempotent: an existing active binding for
     * the same installation is refreshed rather than duplicated.
     *
     * @throws ActivationFailedException     server rejected the key/domain/slot
     * @throws SignatureVerificationException the grant failed signature check
     * @throws TransportException            the server was unreachable
     */
    public function activate(string $licenseKey): LicenseActivation
    {
        $key = trim($licenseKey);

        if ($key === '') {
            throw new ActivationFailedException('A license key is required.');
        }

        $identity = $this->installation->identity();

        $payload = array_merge(['license_key' => $key], $identity);

        // --- Call the server ------------------------------------------------
        $response = $this->client->activate($payload);

        // Application-level rejection (bad key, domain lock, slot full, ...).
        if (($response['success'] ?? false) !== true) {
            $error   = $response['error'] ?? [];
            $message = $error['message'] ?? 'Activation was rejected by the license server.';

            $this->logs->error('activation', 'activate.rejected', $message, [
                'code'            => $error['code'] ?? null,
                'installation_id' => $identity['installation_id'],
            ]);

            throw new ActivationFailedException($message);
        }

        $data      = $response['data'] ?? [];
        $grant     = $data['grant'] ?? null;
        $signature = $response['signature'] ?? '';

        if (! is_array($grant) || $signature === '') {
            throw new ActivationFailedException('The server returned an incomplete activation grant.');
        }

        // --- Verify the RSA signature (fail-closed) -------------------------
        if (! $this->verifier->verify($grant, $signature)) {
            $this->logs->error('activation', 'activate.signature_invalid', 'Grant signature invalid.', [
                'installation_id' => $identity['installation_id'],
            ]);

            throw new SignatureVerificationException('The activation grant failed signature verification.');
        }

        // --- Persist local state -------------------------------------------
        $installationId   = $identity['installation_id'];
        $normalizedDomain = $this->domains->normalize($identity['domain'] ?? null);
        $expiresAt        = $grant['expires_at'] ?? null;

        $setting = $this->licenses->updateOrCreate($installationId, [
            'license_key_encrypted' => Crypt::encryptString($key),
            'license_uuid'          => $grant['license_uuid'] ?? ($data['license_uuid'] ?? null),
            'server_type'           => $identity['server_type'] ?? null,
            'normalized_domain'     => $normalizedDomain,
            'fingerprint_hash'      => $identity['fingerprint'] ?? null,
            'status'                => LicenseStatus::Active->value,
            'last_action'           => 'activate',
            'key_version'           => $grant['key_version'] ?? null,
            'activated_at'          => now(),
            'last_verified_at'      => now(),
            'next_verify_by'        => $this->nextVerifyBy($grant),
            'expires_at'            => $expiresAt,
        ]);

        // The (license_setting_id, installation_id) pair is UNIQUE. On a
        // re-activation for the same installation we must UPDATE the existing
        // row, not insert a second one (which would violate the constraint).
        $attributes = [
            'license_uuid'      => $grant['license_uuid'] ?? null,
            'installation_id'   => $installationId,
            'normalized_domain' => $grant['domain'] ?? $normalizedDomain,
            'is_wildcard'       => $this->domains->isWildcard($grant['domain'] ?? $normalizedDomain),
            'server_type'       => $identity['server_type'] ?? null,
            'fingerprint_hash'  => $identity['fingerprint'] ?? null,
            'os_info'           => $identity['os_info'] ?? null,
            'status'            => 'active',
            'grant_payload'     => $grant,
            'grant_signature'   => $signature,
            'activated_at'      => now(),
            'revoked_at'        => null,
        ];

        $existing = $this->activations->findByInstallation($setting, $installationId);

        if ($existing !== null) {
            $activation = $this->activations->update($existing, $attributes);
        } else {
            // Fresh binding: the server grant carries no activation uuid and
            // the column is UNIQUE, so mint a unique local value.
            $activation = $this->activations->create($attributes + [
                'license_setting_id' => $setting->id,
                'activation_uuid'    => $grant['activation_uuid'] ?? ($data['activation_uuid'] ?? (string) Str::uuid()),
            ]);
        }

        $this->logs->info('activation', 'activate.success', 'Installation activated.', [
            'installation_id' => $installationId,
            'license_uuid'    => $grant['license_uuid'] ?? null,
        ]);

        return $activation;
    }

    /**
     * Local check: is this installation currently bound and active?
     */
    public function isActivated(): bool
    {
        $setting = $this->licenses->current();

        if ($setting === null) {
            return false;
        }

        return $setting->status === LicenseStatus::Active->value
            && $this->activations->activeFor($setting) !== null;
    }

    /** Derive the next-verify deadline from the grant's verify interval. */
    private function nextVerifyBy(array $grant): \Illuminate\Support\Carbon
    {
        $hours = (int) ($grant['verify_interval'] ?? 24);

        return now()->addHours(max(1, $hours));
    }
}
