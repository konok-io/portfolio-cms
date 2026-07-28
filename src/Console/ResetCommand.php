<?php

declare(strict_types=1);

namespace Mrh\License\Console;

use Illuminate\Console\Command;
use Mrh\License\Repositories\Contracts\LogRepositoryInterface;
use Mrh\License\Services\LicenseService;
use Throwable;

/**
 * mrh-license:reset
 * -----------------
 * Release this installation's binding on the server (best effort) and clear
 * all local license state. Requires confirmation unless --force is passed.
 */
class ResetCommand extends Command
{
    protected $signature = 'mrh-license:reset
        {--key= : License key (defaults to MRH_LICENSE_KEY)}
        {--force : Skip the confirmation prompt}';

    protected $description = 'Release the installation binding and clear local state.';

    public function handle(LicenseService $license, LogRepositoryInterface $logs): int
    {
        if (! $this->option('force') && ! $this->confirm('This will clear local license state. Continue?')) {
            $this->line('Aborted.');

            return self::SUCCESS;
        }

        $key = $this->option('key');

        try {
            $license->reset($key !== null ? (string) $key : null);
        } catch (Throwable $e) {
            $logs->error('reset', 'command_error', $e->getMessage(), [
                'command' => 'mrh-license:reset',
            ]);

            $this->error('Reset failed: ' . $e->getMessage());

            return self::FAILURE;
        }

        $this->info('Local license state cleared.');

        return self::SUCCESS;
    }
}
