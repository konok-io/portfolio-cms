<?php

declare(strict_types=1);

namespace Mrh\License\Environment;

use Mrh\License\Contracts\DomainResolver;
use Mrh\License\Contracts\ServerTypeDetector;

/**
 * Classifies the runtime as localhost | domain | vps.
 *
 * IMPORTANT: the values emitted here MUST be in the set the server accepts
 * (App\Http\Requests\Api\ActivateRequest: 'in:localhost,domain,vps'),
 * otherwise activation is rejected with SERVER_TYPE_NOT_ALLOWED.
 *
 * Heuristics (first match wins):
 *   - localhost : host is localhost/127.0.0.1/::1, a *.test/*.local dev
 *                 domain, or the client IP is loopback/private AND the host
 *                 is not a public FQDN.
 *   - domain    : a public, resolvable-looking FQDN (has a dot, public TLD).
 *   - vps       : has a domain/host but looks like a raw server / public IP.
 *
 * The distinction between "domain" and "vps" is a soft signal for the server;
 * the critical case for local testing is detecting localhost correctly.
 */
class EnvironmentServerTypeDetector implements ServerTypeDetector
{
    public function __construct(
        private readonly DomainResolver $domain,
    ) {
    }

    public function detect(): string
    {
        $host = $this->domain->resolve();
        $ip   = $this->clientIp();

        // The HOST (domain) is the authoritative signal for classification.
        // On a local dev machine the client IP is almost always 127.0.0.1 even
        // when the site is accessed via a real domain like "portfolio-cms.test"
        // — so the loopback IP must NOT override a present hostname, or every
        // local domain gets misreported as 'localhost'.

        // 1. An explicit loopback HOSTNAME is localhost.
        if ($this->isLocalHostname($host)) {
            return 'localhost';
        }

        // 2. A real hostname is present → classify by the host, not the IP.
        if ($host !== null && $host !== '') {
            // A bare public/loopback IP used as the host → vps.
            if (filter_var($host, FILTER_VALIDATE_IP) !== false) {
                return 'vps';
            }

            // A normal dotted domain name (incl. .test / .local) → domain.
            if (str_contains($host, '.')) {
                return 'domain';
            }

            // Single-label host that isn't a known loopback name → domain.
            return 'domain';
        }

        // 3. No hostname at all (rare CLI/edge case): fall back to the IP.
        if ($this->isLoopbackIp($ip) || $this->isPrivateIp($ip)) {
            return 'localhost';
        }

        // 4. Nothing conclusive → vps (safest non-local default).
        return 'vps';
    }

    /** Loopback hostnames ONLY. */
    private function isLocalHostname(?string $host): bool
    {
        if ($host === null) {
            return false;
        }

        // Only genuine loopback names are "localhost". Development TLDs like
        // .test / .local are real domain names as far as the server's domain
        // rules are concerned, so they must be classified as 'domain' — not
        // 'localhost' — otherwise a Domain-type license rejects them for
        // sending server_type=localhost, and a Localhost-type license rejects
        // them for using a non-loopback domain. Treating them as 'domain'
        // resolves both.
        return in_array($host, ['localhost', '127.0.0.1', '::1', '[::1]'], true);
    }

    private function clientIp(): ?string
    {
        if (function_exists('request')) {
            try {
                $ip = request()?->ip();
                if (is_string($ip) && $ip !== '') {
                    return $ip;
                }
            } catch (\Throwable) {
                // ignore
            }
        }

        return $_SERVER['SERVER_ADDR'] ?? null;
    }

    private function isLoopbackIp(?string $ip): bool
    {
        return $ip !== null && in_array($ip, ['127.0.0.1', '::1'], true);
    }

    private function isPrivateIp(?string $ip): bool
    {
        if ($ip === null) {
            return false;
        }

        return filter_var(
            $ip,
            FILTER_VALIDATE_IP,
            FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE,
        ) === false && filter_var($ip, FILTER_VALIDATE_IP) !== false;
    }
}
