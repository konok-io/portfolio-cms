<?php

declare(strict_types=1);

namespace Mrh\License\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

/**
 * Package base controller. Kept minimal; exists so package controllers do
 * not depend on the host app's App\Http\Controllers\Controller.
 */
abstract class Controller extends BaseController
{
}
