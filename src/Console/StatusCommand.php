<?php

declare(strict_types=1);

namespace Mrh\License\Console;

use Illuminate\Console\Command;
use Mrh\License\Services\LicenseService;

/**
 * mrh-license:status
 * ------------------
 * Print the current local license status snapshot (no network call).
 */
class StatusCommand extends Command
{
    protected $signature = 'mrh-license:status';

    protected $description = 'Display the current local license status.';

    public function handle(LicenseService $license): int
    {
        $status = $license->status();

        $this->line('<info>MRH License status:</info>');

        foreach ($status as $key => $value) {
            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }
            $this->line(sprintf('  %-18s %s', $key, $value ?? '—'));
        }

        return self::SUCCESS;
    }
}
