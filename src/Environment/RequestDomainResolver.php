<?php

declare(strict_types=1);

namespace Mrh\License\Environment;

use Illuminate\Support\Str;
use Mrh\License\Contracts\DomainResolver;

/**
 * Resolves and normalizes the current domain (strips scheme/port/www,
 * lowercases) to match the server's DomainNormalizer output exactly.
 *
 * Source order:
 *   1. The active HTTP request host (web context).
 *   2. config('app.url') host (CLI / scheduler context).
 * Returns null when neither yields a usable host (e.g. bare CLI).
 */
class RequestDomainResolver implements DomainResolver
{
    public function resolve(): ?string
    {
        $raw = $this->rawHost();

        return $this->normalize($raw);
    }

    /** Best available host string for the current context. */
    private function rawHost(): ?string
    {
        // 1. Live request (web).
        if (function_exists('request')) {
            try {
                $host = request()?->getHost();
                if (is_string($host) && $host !== '') {
                    return $host;
                }
            } catch (\Throwable) {
                // fall through to config
            }
        }

        // 2. Configured app URL (CLI / scheduler).
        $appUrl = (string) config('app.url', '');
        if ($appUrl !== '') {
            $host = parse_url($appUrl, PHP_URL_HOST);
            if (is_string($host) && $host !== '') {
                return $host;
            }
            // app.url without scheme (e.g. "localhost")
            return $appUrl;
        }

        return null;
    }

    /**
     * Mirror App\Support\DomainNormalizer::normalize on the server:
     * lowercase, trim, strip scheme, strip leading www., drop path/port.
     */
    private function normalize(?string $domain): ?string
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
}
