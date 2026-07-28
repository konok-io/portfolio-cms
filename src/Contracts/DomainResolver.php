<?php

declare(strict_types=1);

namespace Mrh\License\Contracts;

/** Produces the current normalized domain (matching server normalization). */
interface DomainResolver
{
    public function resolve(): ?string;
}
