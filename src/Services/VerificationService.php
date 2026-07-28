<?php

declare(strict_types=1);

namespace Mrh\License\Services;

use Mrh\License\Cache\VerificationCache;
use Mrh\License\Enums\VerificationAction;
use Mrh\License\Exceptions\SignatureVerificationException;
use Mrh\License\Exceptions\TransportException;
use Mrh\License\Models\LicenseSetting;
use Mrh\License\Repositories\Contracts\ActivationRepositoryInterface;
use Mrh\License\Repositories\Contracts\LicenseRepositoryInterface;
use Mrh\License\Repositories\Contracts\LogRepositoryInterface;
use Mrh\License\Repositories\Contracts\VerificationRepositoryInterface;
use Mrh\License\Transport\LicenseClient;
use Mrh\License\Transport\ResponseVerifier;

/**
 * VerificationService
 * -------------------
 * Runs the daily signed heartbeat against POST /verify and reconciles the
 * verdict with local state:
 *   - signed continue/grace → keep running, refresh timestamps
 *   - signed expire/kill/deny → block
 *   - signed reactivate → clear binding, require re-activation
 *   - transport failure → hand off to GracePeriodService (fail-open on
 *     transport, fail-closed on a signed denial).
 *
 * The signature check is mandatory before acting on ANY verdict; an unsigned
 * or invalid response must never downgrade the local state.
 */
class VerificationService
{
    public function __construct(
        private readonly LicenseClient $client,
        private readonly ResponseVerifier $verifier,
        private readonly InstallationService $installation,
        private readonly GracePeriodService $grace,
        private readonly VerificationCache $window,
        private readonly LicenseRepositoryInterface $licenses,
        private readonly ActivationRepositoryInterface $activations,
        private readonly VerificationRepositoryInterface $verifications,
        private readonly LogRepositoryInterface $logs,
    ) {
    }

    /**
     * The 24-hour-window entry point used by the scheduler and middleware.
     *
     * Rule:
     *   - verified within the window  → SKIP the server call, return Continue
     *   - stale or never verified     → verify() with the license server
     *
     * Callers that must force a fresh check (e.g. manual re-verify) call
     * verify() directly.
     */
    public function verifyIfDue(string $licenseKey): VerificationAction
    {
        if ($this->window->isFresh()) {
            // Still inside the window — trust the last stored state, no I/O.
            return VerificationAction::Continue;
        }

        return $this->verify($licenseKey);
    }

    /**
     * Perform a verification heartbeat and persist the resulting verdict.
     * Returns the action the client should act on.
     *
     * @throws SignatureVerificationException on a present-but-invalid signature
     */
    public function verify(string $licenseKey): VerificationAction
    {
        $key = trim($licenseKey);

        $setting = $this->licenses->current();

        if ($setting === null) {
            // Never activated — nothing to verify. The guard handles redirect.
            return VerificationAction::Reactivate;
        }

        if ($key === '') {
            $key = $this->installation->licenseKey() ?? '';
        }

        $identity = $this->installation->identity();

        $payload = array_merge([
            'license_key' => $key,
            'domain'      => $identity['domain'] ?? null,
        ], [
            'installation_id' => $identity['installation_id'],
        ]);

        // --- Call the server (transport failure → grace) --------------------
        try {
            $response = $this->client->verify($payload);
        } catch (TransportException $e) {
            $this->logs->error('verification', 'verify.transport_failed', $e->getMessage(), [
                'installation_id' => $identity['installation_id'],
            ]);

            return $this->resolveOffline($setting);
        }

        // Unknown key / unsigned rejection: server sends an error envelope.
        if (($response['success'] ?? false) !== true) {
            $error = $response['error'] ?? [];
            $code  = $error['code'] ?? 'UNKNOWN';

            $this->logs->error('verification', 'verify.rejected', $error['message'] ?? '', [
                'code'            => $code,
                'installation_id' => $identity['installation_id'],
            ]);

            // An unsigned rejection must NOT downgrade local state on its own;
            // treat unreachable-verdict conditions as offline/grace, but a
            // definitive not-found means the binding is gone → reactivate.
            return $code === 'LICENSE_NOT_FOUND'
                ? VerificationAction::Reactivate
                : $this->resolveOffline($setting);
        }

        $data      = $response['data'] ?? [];
        $verdict   = $data['verdict'] ?? null;
        $signature = $response['signature'] ?? '';

        if (! is_array($verdict) || $signature === '') {
            $this->logs->error('verification', 'verify.incomplete', 'Missing verdict/signature.');

            return $this->resolveOffline($setting);
        }

        // --- Signature is mandatory before acting on ANY verdict ------------
        if (! $this->verifier->verify($verdict, $signature)) {
            $this->logs->error('verification', 'verify.signature_invalid', 'Verdict signature invalid.', [
                'installation_id' => $identity['installation_id'],
            ]);

            throw new SignatureVerificationException('The verification verdict failed signature verification.');
        }

        $action = VerificationAction::from((string) $verdict['action']);

        // Normalize verdict fields into the columns saveVerdict expects.
        $verdictForStore = $verdict + [
            'next_verify_by' => $verdict['next_verify_by'] ?? null,
        ];

        $setting = $this->licenses->saveVerdict($setting, $verdictForStore, $signature);
        $this->applySideEffects($setting, $action);

        // Refresh the 24-hour window on any successful (signed) contact.
        $this->window->touch(now(), $setting);

        // Clear any grace bookkeeping now that we have fresh contact.
        if ($action->isOperational()) {
            $this->grace->clearGrace($setting);
        }

        // Record immutable verification history.
        $this->verifications->record([
            'license_setting_id' => $setting->id,
            'action'             => $action->value,
            'result'             => $verdict['result'] ?? null,
            'operational'        => $action->isOperational(),
            'signature_valid'    => true,
            'installation_id'    => $identity['installation_id'],
            'normalized_domain'  => $identity['domain'] ?? null,
            'nonce'              => $response['_nonce'] ?? null,
            'payload_hash'       => hash('sha256', $this->verifier->canonicalize($verdict)),
            'key_version'        => $verdict['key_version'] ?? null,
            'source'             => 'remote',
            'verified_at'        => now(),
            'next_verify_by'     => $verdict['next_verify_by'] ?? null,
            'payload'            => $verdict,
        ]);

        $this->logs->info('verification', 'verify.' . $action->value, 'Signed verdict applied.', [
            'installation_id' => $identity['installation_id'],
            'operational'     => $action->isOperational(),
        ]);

        return $action;
    }

    /**
     * Offline fallback when the license server is unreachable. Drives the
     * grace lifecycle: starts grace on first failure, keeps running while
     * inside the window, marks verification_failed once exceeded.
     *
     * Returns Grace while operational, Expire once verification has failed.
     */
    public function resolveOffline(LicenseSetting $setting): VerificationAction
    {
        $status = $this->grace->handleServerUnavailable($setting);

        return $status === \Mrh\License\Enums\LicenseStatus::Grace
            ? VerificationAction::Grace
            : VerificationAction::Expire;
    }

    /**
     * Apply the local state mutations implied by a signed verdict.
     * (Extracted for testability; called by verify().)
     */
    private function applySideEffects(LicenseSetting $setting, VerificationAction $action): void
    {
        $status = $action->toStatus();

        // Reflect the verdict's implied status locally.
        $this->licenses->markStatus($setting, $status->value);

        // On a kill / deny / reactivate, revoke the active binding so the app
        // is forced back through activation.
        if (in_array($action, [VerificationAction::Kill, VerificationAction::Deny, VerificationAction::Reactivate], true)) {
            $active = $this->activations->activeFor($setting);
            if ($active !== null) {
                $this->activations->revoke($active);
            }
        }
    }
}
