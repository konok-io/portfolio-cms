<?php

declare(strict_types=1);

namespace Mrh\License\Console;

use Illuminate\Console\Command;
use Mrh\License\Models\LicenseLog;

/**
 * mrh-license:logs
 * ----------------
 * Print the most recent license log entries directly in the terminal.
 * A tinker-free way to inspect what happened during activation/verification.
 */
class LogsCommand extends Command
{
    protected $signature = 'mrh-license:logs {--n=15 : How many recent entries to show}';

    protected $description = 'Show the most recent MRH license log entries.';

    public function handle(): int
    {
        $limit = (int) $this->option('n');

        $logs = LicenseLog::query()
            ->latest('id')
            ->take(max(1, $limit))
            ->get(['created_at', 'channel', 'event', 'level', 'endpoint', 'http_status', 'message']);

        if ($logs->isEmpty()) {
            $this->warn('No license log entries found yet.');
            $this->line('That means no activation attempt has reached the logging stage.');

            return self::SUCCESS;
        }

        $this->line('<info>Recent MRH license logs (newest first):</info>');
        $this->newLine();

        foreach ($logs as $log) {
            $color = match ($log->level) {
                'error', 'critical' => 'error',
                'warning'           => 'comment',
                default             => 'info',
            };

            $this->line(sprintf(
                '<%s>[%s] %s.%s</%s>',
                $color,
                $log->level,
                $log->channel,
                $log->event,
                $color,
            ));

            if ($log->endpoint || $log->http_status) {
                $this->line(sprintf('    endpoint=%s http=%s', $log->endpoint ?? '—', $log->http_status ?? '—'));
            }

            if ($log->message) {
                $this->line('    ' . $log->message);
            }

            $this->line('    <fg=gray>' . ($log->created_at ?? '') . '</>');
            $this->newLine();
        }

        return self::SUCCESS;
    }
}
