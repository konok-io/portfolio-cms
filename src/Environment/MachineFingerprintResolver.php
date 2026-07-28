<?php

declare(strict_types=1);

namespace Mrh\License\Environment;

use Illuminate\Contracts\Config\Repository as Config;
use Mrh\License\Contracts\FingerprintResolver;

/**
 * Derives a stable fingerprint hash from machine/environment signals for
 * soft installation binding. Uses only signals that are stable within an
 * install but vary across installs; never fatal if a signal is missing
 * (shared hosts restrict some of these).
 *
 * The result is a hex SHA-256 string — opaque, fixed length, DB-safe.
 */
class MachineFingerprintResolver implements FingerprintResolver
{
    private ?string $cached = null;

    public function __construct(
        private readonly Config $config,
    ) {
    }

    public function resolve(): string
    {
        if ($this->cached !== null) {
            return $this->cached;
        }

        $signals = [
            php_uname('s'),                      // OS name
            php_uname('n'),                      // hostname
            php_uname('m'),                      // machine type
            PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION,
            (string) $this->config->get('app.url', ''),
            $this->safeBasePath(),
            (string) @getmyuid(),
            $_SERVER['DOCUMENT_ROOT'] ?? '',
        ];

        $material = implode('|', array_filter($signals, static fn ($s) => is_string($s) && $s !== ''));

        return $this->cached = hash('sha256', $material);
    }

    private function safeBasePath(): string
    {
        try {
            return function_exists('base_path') ? base_path() : '';
        } catch (\Throwable) {
            return '';
        }
    }
}
