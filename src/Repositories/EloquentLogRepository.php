<?php

declare(strict_types=1);

namespace Mrh\License\Repositories;

use Illuminate\Support\Collection;
use Mrh\License\Models\LicenseLog;
use Mrh\License\Repositories\Contracts\LogRepositoryInterface;

/**
 * Eloquent-backed diagnostic log repository.
 */
class EloquentLogRepository implements LogRepositoryInterface
{
    public function write(array $attributes): LicenseLog
    {
        $attributes['logged_at'] ??= now();

        return LicenseLog::query()->create($attributes);
    }

    public function info(string $channel, string $event, string $message = '', array $context = []): LicenseLog
    {
        return $this->write([
            'channel' => $channel,
            'event'   => $event,
            'level'   => 'info',
            'message' => $message !== '' ? $message : null,
            'context' => $context !== [] ? $context : null,
        ]);
    }

    public function error(string $channel, string $event, string $message = '', array $context = []): LicenseLog
    {
        return $this->write([
            'channel' => $channel,
            'event'   => $event,
            'level'   => 'error',
            'message' => $message !== '' ? $message : null,
            'context' => $context !== [] ? $context : null,
        ]);
    }

    public function recent(int $limit = 50, ?string $channel = null): Collection
    {
        return LicenseLog::query()
            ->when($channel !== null, fn ($q) => $q->where('channel', $channel))
            ->latest('id')
            ->limit($limit)
            ->get();
    }

    public function pruneOlderThan(int $days): int
    {
        return LicenseLog::query()
            ->where('created_at', '<', now()->subDays($days))
            ->delete();
    }
}
