<?php

declare(strict_types=1);

namespace Mrh\License\Http\Requests;

/**
 * Validates a local activation request. The license key may come from the
 * request body or fall back to config('mrh-license.key'), so it is optional
 * here but required by the time the service runs.
 */
class ActivateLicenseRequest extends LicenseFormRequest
{
    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'license_key' => ['nullable', 'string', 'max:191'],
            'domain'      => ['nullable', 'string', 'max:191'],
        ];
    }
}
