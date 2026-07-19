<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Mrh\License\Http\Controllers\ActivationController;
use Mrh\License\Http\Controllers\InstallController;
use Mrh\License\Http\Controllers\LicenseController;
use Mrh\License\Http\Controllers\VerificationController;

/*
|--------------------------------------------------------------------------
| MRH License — Local Endpoints (always loaded)
|--------------------------------------------------------------------------
| Two groups, both under the "license" prefix (in the guard's except list so
| they stay reachable while unlicensed):
|
|   license/activate           HTML activation page (GET) + submit (POST)
|   license/api/*              JSON management endpoints (status/verify/reset)
|
| Protect these behind the host app's admin auth as appropriate.
*/

// HTML activation page (Bootstrap 5). Served to unlicensed installs.
// MUST run in the `web` middleware group so the POST form submit gets
// session + CSRF verification (@csrf). Without `web`, the POST silently
// fails/redirects back to the form — which looks like "nothing happens".
Route::prefix('mrh-license')
    ->middleware('web')
    ->name('mrh.license.')
    ->group(function (): void {
        Route::get('activate', [InstallController::class, 'show'])->name('activate.show');
        Route::post('activate', [InstallController::class, 'activate'])->name('activate.submit');
    });

// JSON management API.
Route::prefix('mrh-license/api')
    ->name('mrh.license.api.')
    ->group(function (): void {
        Route::get('status', [LicenseController::class, 'status'])->name('status');
        Route::post('activate', [ActivationController::class, 'activate'])->name('activate');
        Route::post('verify', [VerificationController::class, 'verify'])->name('verify');
        Route::post('reset', [LicenseController::class, 'reset'])->name('reset');
    });
