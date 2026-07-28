<?php

declare(strict_types=1);

namespace Mrh\License\Contracts;

/** Derives a machine/environment fingerprint hash for binding. */
interface FingerprintResolver
{
    public function resolve(): string;
}
