<?php

declare(strict_types=1);

namespace Mrh\License\Contracts;

/** Produces a stable installation identifier that survives redeploys. */
interface InstallationIdResolver
{
    public function resolve(): string;
}
