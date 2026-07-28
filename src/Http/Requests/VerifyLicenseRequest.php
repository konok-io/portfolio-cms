<?php

declare(strict_types=1);

namespace Mrh\License\Http\Requests;

/**
 * Validates a local verification (heartbeat) trigger.
 */
class VerifyLicenseRequest extends LicenseFormRequest
{
    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'license_key' => ['nullable', 'string', 'max:191'],
        ];
    }
}
