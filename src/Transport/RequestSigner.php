<?php

declare(strict_types=1);

namespace Mrh\License\Transport;

use Illuminate\Support\Str;

/**
 * Adds anti-replay material (nonce + timestamp headers) to outbound
 * requests so the server's PreventReplay middleware is satisfied.
 *
 * The server (App\Http\Middleware\PreventReplay) reads:
 *   - X-Nonce      : a per-request unique token (rejected on reuse)
 *   - X-Timestamp  : unix seconds; rejected if skew > 300s
 *
 * We return BOTH the headers to attach and the generated nonce, so the
 * caller can persist the nonce alongside the verification record.
 */
class RequestSigner
{
    /**
     * Return the anti-replay headers plus the generated nonce.
     *
     * @return array{headers: array<string,string>, nonce: string}
     */
    public function stamp(array $payload = []): array
    {
        $nonce = (string) Str::uuid();

        return [
            'headers' => [
                'X-Nonce'     => $nonce,
                'X-Timestamp' => (string) time(),
            ],
            'nonce' => $nonce,
        ];
    }
}
