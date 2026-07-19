<?php

declare(strict_types=1);

namespace Mrh\License\Contracts;

/**
 * Persists and retrieves the last signed verdict across cache → DB → file.
 * Read on the hot path by LicenseGate; written after each verification.
 */
interface VerdictStore
{
    /** Retrieve the stored verdict payload (or null if none). */
    public function get(): ?array;

    /** Persist a verdict payload and its signature. */
    public function put(array $verdict, string $signature): void;

    /** Clear all stored license state (used by reset). */
    public function forget(): void;
}
