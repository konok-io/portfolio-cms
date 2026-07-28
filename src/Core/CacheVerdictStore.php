<?php

declare(strict_types=1);

namespace Mrh\License\Core;

use Illuminate\Contracts\Cache\Repository as CacheRepository;
use Illuminate\Contracts\Config\Repository as Config;
use Mrh\License\Cache\VerificationCache;
use Mrh\License\Contracts\VerdictStore;
use Mrh\License\Repositories\Contracts\LicenseRepositoryInterface;

/**
 * CacheVerdictStore
 * -----------------
 * Default VerdictStore. Holds the last signed verdict + signature on the fast
 * cache layer, backed by the durable `license_settings` row. The cache is the
 * hot path; the DB is the fallback when the cache is cold.
 *
 * Whenever a verdict is stored, the 24-hour verification window is refreshed
 * via VerificationCache::touch(), so the two systems stay consistent: storing
 * a fresh verdict == resetting the "skip the server" window.
 */
class CacheVerdictStore implements VerdictStore
{
    private const VERDICT_KEY   = 'mrh_license:verdict';
    private const SIGNATURE_KEY = 'mrh_license:signature';

    public function __construct(
        private readonly CacheRepository $cache,
        private readonly Config $config,
        private readonly LicenseRepositoryInterface $licenses,
        private readonly VerificationCache $window,
    ) {
    }

    /** The last stored verdict payload, or null. Cache first, DB fallback. */
    public function get(): ?array
    {
        $cached = $this->cache->get(self::VERDICT_KEY);

        if (is_array($cached)) {
            return $cached;
        }

        $setting = $this->licenses->current();
        $verdict = $setting?->last_verdict;

        if (is_array($verdict)) {
            $this->cache->put(self::VERDICT_KEY, $verdict, $this->ttlSeconds());

            return $verdict;
        }

        return null;
    }

    /** The signature of the last stored verdict, if any. */
    public function signature(): ?string
    {
        $cached = $this->cache->get(self::SIGNATURE_KEY);

        return is_string($cached) ? $cached : null;
    }

    /**
     * Persist a verdict + signature to cache and the durable settings row,
     * and refresh the 24-hour verification window.
     */
    public function put(array $verdict, string $signature): void
    {
        $ttl = $this->ttlSeconds();

        $this->cache->put(self::VERDICT_KEY, $verdict, $ttl);
        $this->cache->put(self::SIGNATURE_KEY, $signature, $ttl);

        $setting = $this->licenses->current();

        if ($setting !== null) {
            $this->licenses->saveVerdict($setting, $verdict, $signature);
        }

        // Storing a fresh verdict resets the "skip the server" window.
        $this->window->touch(setting: $setting);
    }

    /** Clear all cached verdict state (durable rows are cleared by the repo). */
    public function forget(): void
    {
        $this->cache->forget(self::VERDICT_KEY);
        $this->cache->forget(self::SIGNATURE_KEY);
        $this->window->invalidate();
    }

    private function ttlSeconds(): int
    {
        return ((int) $this->config->get('mrh-license.cache_ttl_hours', 24) * 3600) + 300;
    }
}
