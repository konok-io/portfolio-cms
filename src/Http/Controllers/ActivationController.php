<?php

declare(strict_types=1);

namespace Mrh\License\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Mrh\License\Exceptions\ActivationFailedException;
use Mrh\License\Exceptions\SignatureVerificationException;
use Mrh\License\Http\Requests\ActivateLicenseRequest;
use Mrh\License\Http\Responses\JsonApiResponse;
use Mrh\License\Services\LicenseService;

/**
 * ActivationController
 * --------------------
 * Local endpoint that triggers activation of this installation against the
 * license server (via LicenseService → ActivationService). Returns the
 * resulting binding in the canonical JSON envelope.
 */
class ActivationController extends Controller
{
    public function __construct(
        private readonly LicenseService $license,
    ) {
    }

    /** POST license/activate */
    public function activate(ActivateLicenseRequest $request): JsonResponse
    {
        try {
            $activation = $this->license->activate($request->input('license_key'));

            return JsonApiResponse::success([
                'activated'       => true,
                'installation_id' => $activation->installation_id,
                'license_uuid'    => $activation->license_uuid,
                'status'          => $activation->status,
                'activated_at'    => $activation->activated_at?->toIso8601String(),
            ], status: 201);
        } catch (SignatureVerificationException $e) {
            return JsonApiResponse::error(
                code: 'SIGNATURE_INVALID',
                message: 'The activation grant failed signature verification.',
                status: 502,
            );
        } catch (ActivationFailedException $e) {
            return JsonApiResponse::error(
                code: 'ACTIVATION_FAILED',
                message: $e->getMessage(),
                status: 422,
            );
        }
    }
}
