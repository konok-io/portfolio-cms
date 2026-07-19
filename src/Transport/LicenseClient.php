<?php

declare(strict_types=1);

namespace Mrh\License\Transport;

use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Http\Client\Factory as Http;
use Mrh\License\Exceptions\TransportException;
use Mrh\License\Exceptions\LicenseException;

/**
 * HTTP wrapper around the Saudi License Server endpoints:
 *   POST /api/v1/activate
 *   POST /api/v1/verify
 *   POST /api/v1/check-domain
 *   POST /api/v1/check-installation
 *   POST /api/v1/reset
 *
 * Handles base URL, timeouts, retries, anti-replay headers, and JSON
 * envelope decoding. The server ALWAYS replies with the canonical envelope:
 *
 *   { success, data, error:{code,message,details}|null, signature, server_time }
 *
 * Transport-level failures (connection refused, timeout, 5xx) throw a
 * TransportException so the caller can fall back to the grace lifecycle.
 * Application-level rejections (4xx with an error envelope) are returned as
 * the decoded array so the caller can surface the server's message.
 */
class LicenseClient
{
    public function __construct(
        private readonly Http $http,
        private readonly Config $config,
        private readonly RequestSigner $signer,
    ) {
    }

    /** POST /api/v1/activate */
    public function activate(array $payload): array
    {
        return $this->post('activate', $payload);
    }

    /** POST /api/v1/verify */
    public function verify(array $payload): array
    {
        return $this->post('verify', $payload);
    }

    /** POST /api/v1/check-domain */
    public function checkDomain(array $payload): array
    {
        return $this->post('check-domain', $payload);
    }

    /** POST /api/v1/check-installation */
    public function checkInstallation(array $payload): array
    {
        return $this->post('check-installation', $payload);
    }

    /** POST /api/v1/reset */
    public function reset(array $payload): array
    {
        return $this->post('reset', $payload);
    }

    /**
     * Perform a signed POST and decode the JSON envelope.
     *
     * @throws TransportException on network/timeout/5xx (caller → grace)
     * @throws LicenseException   on a malformed (non-envelope) response
     *
     * @return array{success:bool, data:mixed, error:?array, signature:?string, server_time:?string}
     */
    private function post(string $endpoint, array $payload): array
    {
        $url = $this->url($endpoint);

        $maxAttempts    = max(1, (int) $this->config->get('mrh-license.http.retries', 2) + 1);
        $timeout        = (int) $this->config->get('mrh-license.http.timeout', 10);
        $connectTimeout = (int) $this->config->get('mrh-license.http.connect_timeout', 5);

        $lastConnError = null;

        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            // FRESH nonce on every attempt. Reusing a nonce across retries is
            // what triggers the server's anti-replay rejection
            // ("This request has already been processed.").
            $stamp = $this->signer->stamp();

            try {
                $response = $this->http
                    ->acceptJson()
                    ->asJson()
                    ->withHeaders($stamp['headers'])
                    ->timeout($timeout)
                    ->connectTimeout($connectTimeout)
                    ->post($url, $payload);
            } catch (\Illuminate\Http\Client\ConnectionException $e) {
                // Transient network failure — retry with a new nonce.
                $lastConnError = $e;
                if ($attempt < $maxAttempts) {
                    usleep(200_000); // 200ms backoff
                    continue;
                }
                throw new TransportException(
                    "License server unreachable at {$url}: {$e->getMessage()}",
                    previous: $e,
                );
            } catch (\Throwable $e) {
                throw new TransportException(
                    "License server request failed for {$endpoint}: {$e->getMessage()}",
                    previous: $e,
                );
            }

            // 5xx → server broken. Retry once more, else treat as transport failure.
            if ($response->serverError()) {
                if ($attempt < $maxAttempts) {
                    usleep(200_000);
                    continue;
                }
                throw new TransportException(
                    "License server returned HTTP {$response->status()} for {$endpoint}."
                );
            }

            // Any completed 2xx/4xx response is a real verdict — do NOT retry.
            $json = $response->json();

            if (! is_array($json) || ! array_key_exists('success', $json)) {
                // Keep the HTTP status — it's the single most useful clue when
                // the server returns something other than the expected
                // envelope (e.g. a 404 means the server URL is wrong).
                throw new LicenseException(
                    "Unexpected response from the license server for {$endpoint} "
                    . "(HTTP {$response->status()}). Please verify MRH_LICENSE_SERVER_URL."
                );
            }

            $json['_nonce']       = $stamp['nonce'];
            $json['_http_status'] = $response->status();

            return $json;
        }

        // Loop exhausted purely on connection errors.
        throw new TransportException(
            "License server unreachable at {$url}.",
            previous: $lastConnError,
        );
    }

    /** Resolve the absolute endpoint URL under /api/v1. */
    private function url(string $endpoint): string
    {
        $base = rtrim((string) $this->config->get('mrh-license.server_url', ''), '/');

        if ($base === '') {
            throw new LicenseException(
                'MRH License: MRH_LICENSE_SERVER_URL is not configured.'
            );
        }

        return "{$base}/api/v1/{$endpoint}";
    }
}
