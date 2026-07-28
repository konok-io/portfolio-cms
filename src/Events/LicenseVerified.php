<?php

declare(strict_types=1);

namespace Mrh\License\Events;

/**
 * Fired after a successful signed verification (continue).
 * Host applications may listen to react (banners, notifications) without
 * touching package internals.
 */
class LicenseVerified
{
    public function __construct(
        public readonly array $verdict = [],
    ) {
    }
}
