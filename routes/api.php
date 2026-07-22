<?php

declare(strict_types=1);

use App\Http\Controllers\ApiController;
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

/*
|--------------------------------------------------------------------------
| Portfolio CMS Public API
|--------------------------------------------------------------------------
| Public REST API endpoints to fetch portfolio data.
| No authentication required - data is limited to public content.
*/

Route::prefix('portfolio')
    ->name('api.')
    ->group(function (): void {
        Route::get('/', [ApiController::class, 'index'])->name('index');
        Route::get('/about', [ApiController::class, 'about'])->name('about');
        Route::get('/skills', [ApiController::class, 'skills'])->name('skills');
        Route::get('/services', [ApiController::class, 'services'])->name('services');
        Route::get('/projects', [ApiController::class, 'projects'])->name('projects');
        Route::get('/projects/{slug}', [ApiController::class, 'project'])->name('projects.show');
        Route::get('/blogs', [ApiController::class, 'blogs'])->name('blogs');
        Route::get('/blogs/{slug}', [ApiController::class, 'blog'])->name('blogs.show');
        Route::get('/testimonials', [ApiController::class, 'testimonials'])->name('testimonials');
        Route::get('/experience', [ApiController::class, 'experience'])->name('experience');
        Route::get('/education', [ApiController::class, 'education'])->name('education');
        Route::get('/certifications', [ApiController::class, 'certifications'])->name('certifications');
        Route::get('/settings', [ApiController::class, 'settings'])->name('settings');
    });
