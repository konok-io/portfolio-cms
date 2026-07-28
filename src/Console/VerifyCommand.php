<?php

declare(strict_types=1);

namespace Mrh\License\Console;

use Illuminate\Console\Command;
use Mrh\License\Enums\VerificationAction;
use Mrh\License\Repositories\Contracts\LogRepositoryInterface;
use Mrh\License\Services\LicenseService;
use Throwable;

/**
 * mrh-license:verify
 * --------------
 * Runs the signed verification heartbeat against the license server and
 * reconciles the result with local state. Designed to run on a schedule
 * (see the service provider's scheduler registration).
 *
 * By default it respects the 24-hour verification window and skips the
 * network call when the last verdict is still fresh. Use --force to verify
 * immediately regardless of the window.
 *
 * Exit codes:
 *   0  operational (continue / grace / skipped-fresh)
 *   1  non-operational verdict (expire / kill / deny / reactivate)
 *   2  execution error (unexpected exception)
 */
class VerifyCommand extends Command
{
    protected $signature = 'mrh-license:verify
        {--force : Verify now, ignoring the 24-hour cache window}
        {--key= : Override the configured license key}';

    protected $description = 'Run the signed license verification heartbeat.';

    public function handle(LicenseService $license, LogRepositoryInterface $logs): int
    {
        $force = (bool) $this->option('force');
        $key   = $this->option('key');

        $this->line(sprintf(
            '<info>MRH License:</info> verifying%s...',
            $force ? ' (forced)' : '',
        ));

        try {
            $action = $force
                ? $license->verify($key)
                : $license->verifyIfDue($key);
        } catch (Throwable $e) {
            // The service already logs domain-level failures; this captures
            // anything unexpected so the scheduler surfaces a clear signal.
            $logs->error('verification', 'command_error', $e->getMessage(), [
                'command' => 'mrh-license:verify',
                'forced'  => $force,
            ]);

            $this->error('Verification failed: ' . $e->getMessage());

            return self::INVALID; // 2
        }

        return $this->report($action, $logs);
    }

    /** Present the outcome and map it to an exit code. */
    private function report(VerificationAction $action, LogRepositoryInterface $logs): int
    {
        $operational = $action->isOperational();

        $logs->info('verification', 'command_completed', 'mrh-license:verify completed', [
            'action'      => $action->value,
            'operational' => $operational,
        ]);

        $line = 'Verdict: ' . $action->value;

        if ($operational) {
            $this->info($line . ' — operational.');

            return self::SUCCESS; // 0
        }

        $this->warn($line . ' — NOT operational. The application will be blocked.');

        return self::FAILURE; // 1
    }
}
