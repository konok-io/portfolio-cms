<?php

declare(strict_types=1);

namespace Mrh\License\Console;

use Illuminate\Console\Command;
use Mrh\License\Repositories\Contracts\LogRepositoryInterface;
use Mrh\License\Services\LicenseService;
use Throwable;

/**
 * mrh-license:activate
 * --------------------
 * CLI activation. Binds this installation to a license by calling the
 * license server. The key may be passed with --key or read from
 * config('mrh-license.key') (MRH_LICENSE_KEY).
 *
 * Exit codes: 0 success, 1 rejected/failed.
 */
class ActivateCommand extends Command
{
    protected $signature = 'mrh-license:activate {--key= : License key (defaults to MRH_LICENSE_KEY)}';

    protected $description = 'Bind this installation to a license via the server.';

    public function handle(LicenseService $license, LogRepositoryInterface $logs): int
    {
        $key = (string) ($this->option('key') ?? '');

        if ($key === '') {
            $key = (string) config('mrh-license.key', '');
        }

        if ($key === '') {
            $this->error('No license key provided. Pass --key=... or set MRH_LICENSE_KEY in .env.');

            return self::FAILURE;
        }

        $this->line('<info>MRH License:</info> activating...');

        try {
            $activation = $license->activate($key);
        } catch (Throwable $e) {
            $logs->error('activation', 'command_error', $e->getMessage(), [
                'command' => 'mrh-license:activate',
            ]);

            $this->error('Activation failed: ' . $e->getMessage());

            return self::FAILURE;
        }

        $this->info(sprintf(
            'Activated. installation_id=%s status=%s',
            $activation->installation_id,
            $activation->status,
        ));

        return self::SUCCESS;
    }
}
