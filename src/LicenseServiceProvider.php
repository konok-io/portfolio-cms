<?php

declare(strict_types=1);

namespace Mrh\License;

use Illuminate\Support\ServiceProvider;
use Mrh\License\Repositories\Contracts\ActivationRepositoryInterface;
use Mrh\License\Repositories\Contracts\LicenseRepositoryInterface;
use Mrh\License\Repositories\Contracts\LogRepositoryInterface;
use Mrh\License\Repositories\Contracts\VerificationRepositoryInterface;
use Mrh\License\Repositories\EloquentActivationRepository;
use Mrh\License\Repositories\EloquentLicenseRepository;
use Mrh\License\Repositories\EloquentLogRepository;
use Mrh\License\Repositories\EloquentVerificationRepository;

/**
 * Package entry point.
 *
 * Responsibilities (to be implemented):
 *  - Merge + publish config (config/mrh-license.php).
 *  - Publish the bundled RSA public key (resources/keys/public.pem).
 *  - Load migrations, views, and optional install routes.
 *  - Bind Contracts to concrete implementations (resolvers, store, verifier).
 *  - Register the global EnsureLicenseValid middleware.
 *  - Register Artisan commands (activate/verify/status/reset).
 */
class LicenseServiceProvider extends ServiceProvider
{
    /**
     * Repository interface → Eloquent implementation bindings.
     *
     * @var array<class-string, class-string>
     */
    private array $repositories = [
        LicenseRepositoryInterface::class      => EloquentLicenseRepository::class,
        ActivationRepositoryInterface::class   => EloquentActivationRepository::class,
        VerificationRepositoryInterface::class => EloquentVerificationRepository::class,
        LogRepositoryInterface::class          => EloquentLogRepository::class,
    ];

    /** Register container bindings. */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/mrh-license.php', 'mrh-license');

        foreach ($this->repositories as $interface => $implementation) {
            $this->app->singleton($interface, $implementation);
        }

        // Transport layer — HTTP client + request/response crypto helpers.
        $this->app->singleton(\Mrh\License\Transport\RequestSigner::class);
        $this->app->singleton(\Mrh\License\Transport\ResponseVerifier::class, function ($app) {
            return new \Mrh\License\Transport\ResponseVerifier($app['config']);
        });
        $this->app->singleton(\Mrh\License\Transport\LicenseClient::class, function ($app) {
            return new \Mrh\License\Transport\LicenseClient(
                $app->make(\Illuminate\Http\Client\Factory::class),
                $app['config'],
                $app->make(\Mrh\License\Transport\RequestSigner::class),
            );
        });

        // Domain services — concrete singletons resolved via constructor DI.
        // Leaf services (Domain, GracePeriod, Installation) first, then the
        // composites that depend on them, then the aggregate LicenseService.
        $this->app->singleton(\Mrh\License\Services\DomainService::class);
        $this->app->singleton(\Mrh\License\Services\GracePeriodService::class);
        $this->app->singleton(\Mrh\License\Services\InstallationService::class);
        $this->app->singleton(\Mrh\License\Services\ActivationService::class);
        $this->app->singleton(\Mrh\License\Services\VerificationService::class);
        $this->app->singleton(\Mrh\License\Services\LicenseService::class);

        // Facade accessor → the aggregate service.
        $this->app->singleton('mrh.license', fn ($app) => $app->make(\Mrh\License\Services\LicenseService::class));

        // Environment resolver Contracts → concrete implementations. Bound as
        // singletons so each signal is resolved once per request.
        $this->app->singleton(
            \Mrh\License\Contracts\InstallationIdResolver::class,
            \Mrh\License\Environment\InstallationIdGenerator::class,
        );
        $this->app->singleton(
            \Mrh\License\Contracts\FingerprintResolver::class,
            \Mrh\License\Environment\MachineFingerprintResolver::class,
        );
        $this->app->singleton(
            \Mrh\License\Contracts\DomainResolver::class,
            \Mrh\License\Environment\RequestDomainResolver::class,
        );
        $this->app->singleton(
            \Mrh\License\Contracts\ServerTypeDetector::class,
            \Mrh\License\Environment\EnvironmentServerTypeDetector::class,
        );

        // Verification cache system: the 24-hour window gate + the tiered
        // verdict store that refreshes it on every stored verdict.
        $this->app->singleton(\Mrh\License\Cache\VerificationCache::class);
        $this->app->singleton(
            \Mrh\License\Contracts\VerdictStore::class,
            \Mrh\License\Core\CacheVerdictStore::class,
        );
    }

    /** Bootstrap package services. */
    public function boot(): void
    {
        // Migrations, views, and local management routes.
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'mrh-license');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');

        if ((bool) config('mrh-license.install_wizard', false)) {
            $this->loadRoutesFrom(__DIR__ . '/../routes/install.php');
        }

        $this->registerGuard();

        if ($this->app->runningInConsole()) {
            $this->registerPublishing();

            $this->commands([
                \Mrh\License\Console\ActivateCommand::class,
                \Mrh\License\Console\VerifyCommand::class,
                \Mrh\License\Console\StatusCommand::class,
                \Mrh\License\Console\ResetCommand::class,
                \Mrh\License\Console\LogsCommand::class,
            ]);

            $this->registerSchedule();
        }
    }

    /**
     * Schedule the daily verification heartbeat. The command itself respects
     * the 24-hour window, so running it more often than daily is harmless —
     * it simply skips when the last verdict is still fresh. We schedule it
     * hourly by default for resilience on hosts that miss a run, and daily as
     * the guaranteed cadence.
     */
    private function registerSchedule(): void
    {
        if (! (bool) config('mrh-license.schedule.enabled', true)) {
            return;
        }

        $this->app->booted(function (): void {
            /** @var \Illuminate\Console\Scheduling\Schedule $schedule */
            $schedule = $this->app->make(\Illuminate\Console\Scheduling\Schedule::class);

            $cron = (string) config('mrh-license.schedule.cron', '');

            $event = $schedule->command('mrh-license:verify');

            if ($cron !== '') {
                $event->cron($cron);
            } else {
                $event->hourly();
            }

            $event->withoutOverlapping()
                ->runInBackground()
                ->onOneServer();
        });
    }

    /**
     * Register the global, route-independent license guard on the web group.
     * Uses an alias too, so hosts can attach it selectively if they prefer.
     */
    private function registerGuard(): void
    {
        $router = $this->app['router'];

        $router->aliasMiddleware(
            'mrh.license',
            \Mrh\License\Http\Middleware\EnsureLicenseValid::class,
        );

        if ((bool) config('mrh-license.guard.enabled', true)) {
            // Appended to `web` so it runs after session/auth are available,
            // which lets the except-list cover login/password-reset cleanly.
            $router->pushMiddlewareToGroup('web', \Mrh\License\Http\Middleware\EnsureLicenseValid::class);
        }
    }

    /** Publishable assets (config, public key, views). */
    private function registerPublishing(): void
    {
        $this->publishes([
            __DIR__ . '/../config/mrh-license.php' => config_path('mrh-license.php'),
        ], 'mrh-license-config');

        $this->publishes([
            __DIR__ . '/../resources/keys/public.pem' => storage_path('mrh-license/public.pem'),
        ], 'mrh-license-key');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/mrh-license'),
        ], 'mrh-license-views');

        // Convenience tag that publishes everything.
        $this->publishes([
            __DIR__ . '/../config/mrh-license.php'    => config_path('mrh-license.php'),
            __DIR__ . '/../resources/keys/public.pem' => storage_path('mrh-license/public.pem'),
        ], 'mrh-license');
    }
}
