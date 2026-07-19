<?php

declare(strict_types=1);

namespace Mrh\License\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Mrh\License\Services\InstallationService;
use Mrh\License\Services\LicenseService;
use Throwable;

/**
 * InstallController
 * -----------------
 * Serves the Bootstrap 5 activation page and handles the activation form
 * submission. Reachable while unlicensed because `license/*` is in the
 * guard's except list. CLI activation (`php artisan license:activate`)
 * remains available regardless of this controller.
 */
class InstallController extends Controller
{
    public function __construct(
        private readonly LicenseService $license,
        private readonly InstallationService $installation,
    ) {
    }

    /** GET license/activate — show the activation form. */
    public function show(): View|RedirectResponse
    {
        // Already activated? Don't show the form again — send them home.
        if ($this->license->isActivated()) {
            return redirect()->to('/');
        }

        return view('mrh-license::pages.activate', [
            'serverType' => $this->installation->serverType(),
            'domain'     => $this->installation->domain(),
        ]);
    }

    /** POST license/activate — handle an activation submission. */
    public function activate(Request $request): RedirectResponse
    {
        $request->validate([
            'license_key' => ['required', 'string', 'max:191'],
        ]);

        try {
            $this->license->activate($request->string('license_key')->toString());
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->with('mrh_license_error', $e->getMessage());
        }

        return redirect()->to('/');
    }
}
