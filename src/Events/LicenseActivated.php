<?php

declare(strict_types=1);

namespace Mrh\License\Events;

/**
 * Fired after a successful activation and stored grant.
 * Host applications may listen to react (banners, notifications) without
 * touching package internals.
 */
class LicenseActivated
{
    public function __construct(
        public readonly array $verdict = [],
    ) {
    }
}
