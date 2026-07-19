<?php

declare(strict_types=1);

namespace Mrh\License\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed activate()
 * @method static mixed verify()
 * @method static mixed status()
 * @method static mixed reset()
 *
 * Thin static entry point resolving to Mrh\License\Core\LicenseManager.
 */
class License extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'mrh.license';
    }
}
