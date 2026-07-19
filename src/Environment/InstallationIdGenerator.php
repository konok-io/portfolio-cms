<?php

declare(strict_types=1);

namespace Mrh\License\Environment;

use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Support\Str;
use Mrh\License\Contracts\InstallationIdResolver;
use Throwable;

/**
 * InstallationIdGenerator
 * -----------------------
 * Produces a stable, unique installation identifier for THIS deployment.
 *
 * Design goals:
 *   - Stable    : the same value on every call, for the life of the install,
 *                 surviving redeploys, cache flushes and `migrate:fresh`.
 *   - Unique    : distinct per physical/logical install (no collisions).
 *   - Portable  : works identically on localhost, shared hosting and VPS
 *                 without assuming CLI, cron, or writable system paths.
 *
 * Strategy (first hit wins on read; all available layers written on create):
 *   1. In-memory cache for the current request.
 *   2. Persisted id file (default: storage/app/mrh-license.dat) — the
 *      canonical durable location on every environment.
 *   3. A hidden fallback file outside storage/ (base_path/.mrh-install-id)
 *      so the id survives `php artisan storage:link`/cache clears and some
 *      deploy strategies that wipe storage/app.
 *   4. If nothing is found, generate a fresh UUIDv4, seeded/blended with a
 *      soft machine fingerprint for extra entropy, then persist to every
 *      writable layer above.
 *
 * The id is intentionally NOT derived purely from hardware, because shared
 * hosts virtualize/rotate hardware signals; a persisted random UUID is the
 * only reliably-stable-yet-unique approach across all three environments.
 * The machine fingerprint is mixed in only as extra entropy at creation.
 */
class InstallationIdGenerator implements InstallationIdResolver
{
    /** Prefix makes ids self-describing in logs/DB (e.g. mrh_9f8c...). */
    private const PREFIX = 'mrh_';

    /** Request-scoped memoization. */
    private ?string $cached = null;

    public function __construct(
        private readonly Config $config,
    ) {
    }

    /**
     * Return the stable installation id, generating + persisting one on the
     * very first call for this installation.
     */
    public function resolve(): string
    {
        if ($this->cached !== null) {
            return $this->cached;
        }

        // 1–3. Try to read an existing id from any durable layer.
        $existing = $this->readFromFile($this->primaryPath())
            ?? $this->readFromFile($this->fallbackPath());

        if ($existing !== null) {
            return $this->cached = $existing;
        }

        // 4. None found — create and persist a new one.
        $id = $this->generate();
        $this->persist($id);

        return $this->cached = $id;
    }

    /**
     * Generate a new, unique id: a UUIDv4 blended with a soft machine
     * fingerprint hash for additional entropy. The random component alone
     * guarantees uniqueness; the fingerprint just diversifies the seed.
     */
    private function generate(): string
    {
        $random      = (string) Str::uuid();
        $fingerprint = $this->machineFingerprint();

        // Deterministic-length, opaque, url/DB-safe token.
        $token = substr(hash('sha256', $random . '|' . $fingerprint), 0, 40);

        return self::PREFIX . $token;
    }

    /**
     * A best-effort machine fingerprint. Uses only signals that are stable
     * within an install but vary across installs. Never fatal if a signal is
     * unavailable (shared hosts restrict some of these).
     */
    private function machineFingerprint(): string
    {
        $signals = [
            php_uname('n'),                              // hostname
            php_uname('m'),                              // machine type
            $this->config->get('app.url', ''),          // configured app url
            base_path(),                                 // absolute install path
            (string) getmyuid(),                         // process owner (shared hosting)
            $_SERVER['SERVER_NAME']  ?? '',              // vhost (shared hosting)
            $_SERVER['DOCUMENT_ROOT'] ?? '',             // docroot (shared hosting)
        ];

        return hash('sha256', implode('|', array_filter($signals, 'is_string')));
    }

    /**
     * Write the id to every writable durable layer, so a wipe of any single
     * location still leaves a copy to recover from.
     */
    private function persist(string $id): void
    {
        $this->writeToFile($this->primaryPath(), $id);
        $this->writeToFile($this->fallbackPath(), $id);
    }

    /** Canonical durable location (configurable). */
    private function primaryPath(): string
    {
        return (string) $this->config->get(
            'mrh-license.storage.file_mirror',
            storage_path('app/mrh-license.dat'),
        );
    }

    /**
     * Secondary location outside storage/, used to survive deploy strategies
     * or maintenance commands that clear storage/app.
     */
    private function fallbackPath(): string
    {
        return base_path('.mrh-install-id');
    }

    /** Read a trimmed, validated id from a file, or null on any failure. */
    private function readFromFile(string $path): ?string
    {
        try {
            if (! is_file($path) || ! is_readable($path)) {
                return null;
            }

            $value = trim((string) file_get_contents($path));

            return $this->isValid($value) ? $value : null;
        } catch (Throwable) {
            return null;
        }
    }

    /** Write the id, creating the directory if needed. Never throws. */
    private function writeToFile(string $path, string $id): void
    {
        try {
            $dir = dirname($path);

            if (! is_dir($dir)) {
                @mkdir($dir, 0755, true);
            }

            if (is_dir($dir) && is_writable($dir)) {
                @file_put_contents($path, $id, LOCK_EX);
                @chmod($path, 0640);
            }
        } catch (Throwable) {
            // Persistence is best-effort; a read-only layer must not break
            // resolution. At least one layer is typically writable.
        }
    }

    /** Shape check so a corrupted/partial file is treated as "no id". */
    private function isValid(string $value): bool
    {
        return $value !== ''
            && str_starts_with($value, self::PREFIX)
            && strlen($value) === strlen(self::PREFIX) + 40;
    }
}
