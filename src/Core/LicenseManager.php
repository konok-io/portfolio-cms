<?php

declare(strict_types=1);

namespace Mrh\License\Core;

use Mrh\License\Enums\VerificationAction;
use Mrh\License\Models\LicenseActivation;
use Mrh\License\Services\LicenseService;

/**
 * Orchestrator behind the License facade. Thin delegator over LicenseService
 * (the real implementation) so the static facade API stays stable while the
 * business logic lives in the service layer.
 */
class LicenseManager
{
    public function __construct(
        private readonly LicenseService $license,
    ) {
    }

    /** Bind this installation to a license (POST /activate). */
    public function activate(?string $licenseKey = null): LicenseActivation
    {
        return $this->license->activate($licenseKey);
    }

    /** Daily signed heartbeat (POST /verify). */
    public function verify(?string $licenseKey = null): VerificationAction
    {
        return $this->license->verify($licenseKey);
    }

    /** Current local license status without hitting the network. */
    public function status(): array
    {
        return $this->license->status();
    }

    /** Release the installation binding (POST /reset) and clear local state. */
    public function reset(?string $licenseKey = null): void
    {
        $this->license->reset($licenseKey);
    }
}
