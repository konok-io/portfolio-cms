<?php

declare(strict_types=1);

namespace Mrh\License\Repositories\Contracts;

use Illuminate\Support\Collection;
use Mrh\License\Models\LicenseLog;

/**
 * Persistence boundary for the unified diagnostic/transport log.
 */
interface LogRepositoryInterface
{
    /** Write a log entry (channel/event/level + context). */
    public function write(array $attributes): LicenseLog;

    /** Convenience: info-level entry. */
    public function info(string $channel, string $event, string $message = '', array $context = []): LicenseLog;

    /** Convenience: error-level entry. */
    public function error(string $channel, string $event, string $message = '', array $context = []): LicenseLog;

    /** Recent entries, newest first, optionally filtered by channel. */
    public function recent(int $limit = 50, ?string $channel = null): Collection;

    /** Delete entries older than the given number of days; returns count. */
    public function pruneOlderThan(int $days): int;
}
