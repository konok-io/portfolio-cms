<?php

declare(strict_types=1);

namespace Mrh\License\Services;

use Illuminate\Support\Str;

/**
 * DomainService
 * -------------
 * Normalizes and matches domains using EXACTLY the same rules as the
 * server's App\Support\DomainNormalizer, so a domain locked on the server
 * matches what this client computes. Keep these two in lockstep.
 *
 * Rules: lowercase, trim, strip scheme, strip leading "www.", drop
 * path/query/port.
 */
class DomainService
{
    /** Normalize a raw domain/host string, or null if empty. */
    public function normalize(?string $domain): ?string
    {
        if ($domain === null || trim($domain) === '') {
            return null;
        }

        $value = Str::lower(trim($domain));
        $value = preg_replace('#^https?://#', '', $value) ?? $value;
        $value = preg_replace('#^www\.#', '', $value) ?? $value;
        $value = explode('/', $value)[0];
        $value = explode(':', $value)[0];

        return $value !== '' ? $value : null;
    }

    /** Whether a normalized domain is a wildcard (*.example.com). */
    public function isWildcard(?string $domain): bool
    {
        return $domain !== null && str_starts_with($domain, '*.');
    }

    /**
     * Whether a candidate domain matches a bound domain, honoring wildcards.
     * Mirrors the server's domainMatches() logic.
     */
    public function matches(?string $candidate, ?string $bound): bool
    {
        $candidate = $this->normalize($candidate);
        $bound     = $this->normalize($bound);

        if ($candidate === null || $bound === null) {
            return false;
        }

        if ($candidate === $bound) {
            return true;
        }

        if (str_starts_with($bound, '*.')) {
            $base = substr($bound, 2);

            return $candidate === $base || str_ends_with($candidate, '.' . $base);
        }

        return false;
    }
}
