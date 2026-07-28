<?php

declare(strict_types=1);

namespace Mrh\License\Transport;

use Illuminate\Contracts\Config\Repository as Config;
use RuntimeException;

/**
 * Verifies the RSA signature on server responses using the bundled public
 * key. Canonicalizes the payload IDENTICALLY to the server
 * (App\Services\Api\RsaSignatureService::canonicalize) so the signature
 * check matches. A failed check must fail-closed.
 *
 * Canonicalization contract (must mirror the server exactly):
 *   - recursively ksort every associative level
 *   - json_encode with JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
 *     | JSON_PRESERVE_ZERO_FRACTION
 *   - verify with OPENSSL_ALGO_SHA256 over the raw canonical bytes
 */
class ResponseVerifier
{
    public function __construct(
        private readonly Config $config,
    ) {
    }

    /** Verify the base64 signature over the given payload; true if authentic. */
    public function verify(array $payload, string $signature): bool
    {
        $decoded = base64_decode($signature, true);

        if ($decoded === false || $decoded === '') {
            return false;
        }

        $publicKey = $this->loadPublicKey();
        $canonical = $this->canonicalize($payload);

        $result = openssl_verify(
            $canonical,
            $decoded,
            $publicKey,
            $this->algorithm(),
        );

        return $result === 1;
    }

    /**
     * Canonical string form of a payload for signing/verifying.
     * MUST match the server's canonicalize() byte-for-byte.
     */
    public function canonicalize(array $payload): string
    {
        $normalize = function (array $data) use (&$normalize): array {
            ksort($data);
            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    $data[$key] = $normalize($value);
                }
            }

            return $data;
        };

        return json_encode(
            $normalize($payload),
            JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRESERVE_ZERO_FRACTION,
        ) ?: '';
    }

    /** The signature algorithm — kept in lockstep with the server. */
    private function algorithm(): int
    {
        return OPENSSL_ALGO_SHA256;
    }

    /** @return \OpenSSLAsymmetricKey */
    private function loadPublicKey()
    {
        $pem = $this->publicKeyPem();

        $key = openssl_pkey_get_public($pem);

        if ($key === false) {
            throw new RuntimeException(
                'MRH License: invalid or missing RSA public key. '
                . 'Publish/replace resources/keys/public.pem with the key exported '
                . 'from the license server. ' . (string) openssl_error_string()
            );
        }

        return $key;
    }

    /**
     * Resolve the public key PEM. Precedence:
     *   1. config('mrh-license.public_key_path') if set and readable
     *   2. the published storage path storage/mrh-license/public.pem
     *   3. the package's bundled resources/keys/public.pem
     */
    private function publicKeyPem(): string
    {
        $candidates = [];

        $configured = $this->config->get('mrh-license.public_key_path');
        if (is_string($configured) && $configured !== '') {
            $candidates[] = $configured;
        }

        if (function_exists('storage_path')) {
            $candidates[] = storage_path('mrh-license/public.pem');
        }

        $candidates[] = __DIR__ . '/../../resources/keys/public.pem';

        foreach ($candidates as $path) {
            if (is_string($path) && is_readable($path)) {
                $contents = file_get_contents($path);
                if ($contents !== false && str_contains($contents, 'BEGIN PUBLIC KEY')) {
                    return $contents;
                }
            }
        }

        throw new RuntimeException(
            'MRH License: RSA public key not found. Looked in: '
            . implode(', ', array_filter($candidates, 'is_string'))
        );
    }
}
