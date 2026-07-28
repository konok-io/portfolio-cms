<?php

declare(strict_types=1);

namespace Mrh\License\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Mrh\License\Http\Requests\ResetLicenseRequest;
use Mrh\License\Http\Responses\JsonApiResponse;
use Mrh\License\Services\LicenseService;
use Throwable;

/**
 * LicenseController
 * -----------------
 * Local, read-mostly endpoints for inspecting and releasing this
 * installation's license. Consumed by the host app's admin UI or ops
 * tooling — NOT the license server. Delegates to LicenseService.
 */
class LicenseController extends Controller
{
    public function __construct(
        private readonly LicenseService $license,
    ) {
    }

    /** GET license/status — current local status snapshot (no network). */
    public function status(): JsonResponse
    {
        return JsonApiResponse::success($this->license->status());
    }

    /** POST license/reset — release this installation's binding. */
    public function reset(ResetLicenseRequest $request): JsonResponse
    {
        try {
            $this->license->reset($request->input('license_key'));

            return JsonApiResponse::success(['reset' => true]);
        } catch (Throwable $e) {
            return JsonApiResponse::error(
                code: 'RESET_FAILED',
                message: $e->getMessage(),
                status: 422,
            );
        }
    }
}
