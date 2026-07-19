<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Mrh\License\Http\Controllers\InstallController;

/*
|--------------------------------------------------------------------------
| MRH License — Optional Wizard Extras
|--------------------------------------------------------------------------
| Loaded only when config('mrh-license.install_wizard') is true. The core
| activation page lives in api.php and is always available; this file is for
| optional extras a full wizard might add.
*/

Route::prefix('mrh-license')->name('mrh.license.')->group(function (): void {
    Route::get('blocked', [InstallController::class, 'show'])->name('blocked');
});
