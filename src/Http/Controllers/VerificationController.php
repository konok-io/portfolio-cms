<?php

declare(strict_types=1);

namespace Mrh\License\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Mrh\License\Enums\VerificationAction;
use Mrh\License\Exceptions\SignatureVerificationException;
use Mrh\License\Http\Requests\VerifyLicenseRequest;
use Mrh\License\Http\Responses\JsonApiResponse;
use Mrh\License\Services\LicenseService;

/**
 * VerificationController
 * ----------------------
 * Local endpoint to trigger an on-demand verification heartbeat. The
 * scheduled command is the primary driver; this exists for manual re-checks
 * from an admin UI. Returns the resolved action and whether the app remains
 * operational.
 */
class VerificationController extends Controller
{
    public function __construct(
        private readonly LicenseService $license,
    ) {
    }

    /** POST license/verify */
    public function verify(VerifyLicenseRequest $request): JsonResponse
    {
        try {
            $action = $this->license->verify($request->input('license_key'));

            // A signed denial is a valid outcome, not a transport error:
            // report it truthfully with a 200 envelope + operational flag.
            return JsonApiResponse::success([
                'verified'    => true,
                'action'      => $action->value,
                'operational' => $action->isOperational(),
            ]);
        } catch (SignatureVerificationException $e) {
            return JsonApiResponse::error(
                code: 'SIGNATURE_INVALID',
                message: 'The verification verdict failed signature verification.',
                status: 502,
            );
        }
    }
}
