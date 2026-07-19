<?php

declare(strict_types=1);

namespace Mrh\License\Events;

/**
 * Fired when the app falls back to the grace window.
 * Host applications may listen to react (banners, notifications) without
 * touching package internals.
 */
class LicenseEnteredGrace
{
    public function __construct(
        public readonly array $verdict = [],
    ) {
    }
}
