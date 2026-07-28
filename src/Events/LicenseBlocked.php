<?php

declare(strict_types=1);

namespace Mrh\License\Events;

/**
 * Fired when a signed kill/expire/deny blocks the app.
 * Host applications may listen to react (banners, notifications) without
 * touching package internals.
 */
class LicenseBlocked
{
    public function __construct(
        public readonly array $verdict = [],
    ) {
    }
}
