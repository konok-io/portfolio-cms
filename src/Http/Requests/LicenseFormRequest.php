<?php

declare(strict_types=1);

namespace Mrh\License\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Mrh\License\Http\Responses\JsonApiResponse;

/**
 * Base Form Request for the package's local endpoints.
 * Forces validation failures into the canonical JSON error envelope instead
 * of a redirect, so every local endpoint is JSON-consistent.
 */
abstract class LicenseFormRequest extends FormRequest
{
    /** Local endpoints are gated by the host app's own auth/middleware. */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            JsonApiResponse::error(
                code: 'VALIDATION_FAILED',
                message: 'The given data was invalid.',
                details: $validator->errors()->toArray(),
                status: 422,
            )
        );
    }
}
