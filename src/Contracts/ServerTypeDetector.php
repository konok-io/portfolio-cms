<?php

declare(strict_types=1);

namespace Mrh\License\Contracts;

/** Classifies the runtime environment: localhost | shared | vps. */
interface ServerTypeDetector
{
    public function detect(): string;
}
