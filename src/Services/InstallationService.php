<?php

declare(strict_types=1);

namespace Mrh\License\Services;

use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Support\Facades\Crypt;
use Mrh\License\Contracts\DomainResolver;
use Mrh\License\Contracts\FingerprintResolver;
use Mrh\License\Contracts\InstallationIdResolver;
use Mrh\License\Contracts\ServerTypeDetector;
use Mrh\License\Repositories\Contracts\LicenseRepositoryInterface;

/**
 * InstallationService
 * -------------------
 * Assembles the environment identity of this installation: stable
 * installation id, machine fingerprint, current domain, and server type.
 * Produces the identity block attached to every outbound license request.
 *
 * Depends only on resolver abstractions (DIP) so each signal can be swapped
 * or stubbed independently.
 */
class InstallationService
{
    public function __construct(
        private readonly InstallationIdResolver $installationId,
        private readonly FingerprintResolver $fingerprint,
        private readonly DomainResolver $domain,
        private readonly ServerTypeDetector $serverType,
        private readonly Config $config,
        private readonly LicenseRepositoryInterface $licenses,
    ) {
    }

    /** The stable installation identifier for this deployment. */
    public function installationId(): string
    {
        return $this->installationId->resolve();
    }

    /** The machine/environment fingerprint hash. */
    public function fingerprint(): string
    {
        return $this->fingerprint->resolve();
    }

    /** Current normalized domain (may be null on CLI/localhost). */
    public function domain(): ?string
    {
        return $this->domain->resolve();
    }

    /** localhost | shared | vps */
    public function serverType(): string
    {
        // Explicit override wins: set MRH_LICENSE_SERVER_TYPE=domain|localhost|vps
        // in .env to bypass auto-detection entirely. Useful for local domains
        // like *.test where the machine is local but the site is a domain.
        $forced = config('mrh-license.server_type');
        if (is_string($forced) && in_array($forced, ['localhost', 'domain', 'vps'], true)) {
            return $forced;
        }

        return $this->serverType->detect();
    }

    /**
     * The identity payload attached to activation/verification requests.
     *
     * @return array<string, mixed>
     */
    public function identity(): array
    {
        return [
            'installation_id' => $this->installationId(),
            'domain'          => $this->domain(),
            'server_type'     => $this->serverType(),
            'fingerprint'     => $this->fingerprint(),
            'os_info'         => php_uname('s') . ' ' . php_uname('r'),
        ];
    }

    /** The configured license key for this installation. */
    public function licenseKey(): ?string
    {
        // Prefer the key captured at activation time (stored encrypted in the
        // license_settings row). This is what web-form activations use — the
        // key never lives in .env in that flow. Fall back to the configured
        // MRH_LICENSE_KEY for CLI/headless setups that pin it in .env.
        $setting = $this->licenses->current();

        if ($setting !== null && ! empty($setting->license_key_encrypted)) {
            try {
                return Crypt::decryptString($setting->license_key_encrypted);
            } catch (\Throwable) {
                // Corrupt/rotated app key — fall through to config.
            }
        }

        return $this->config->get('mrh-license.key');
    }
}
