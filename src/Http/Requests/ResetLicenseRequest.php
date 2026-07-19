<?php

declare(strict_types=1);

namespace Mrh\License\Http\Requests;

/**
 * Validates a local reset request (release this installation's binding).
 */
class ResetLicenseRequest extends LicenseFormRequest
{
    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'license_key' => ['nullable', 'string', 'max:191'],
            'reason'      => ['nullable', 'string', 'max:255'],
        ];
    }
}
