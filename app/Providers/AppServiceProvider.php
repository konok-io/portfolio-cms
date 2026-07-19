<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Ensure compatibility with older MySQL / MariaDB versions
        Schema::defaultStringLength(191);

        // Use Bootstrap 5 for pagination
        Paginator::useBootstrapFive();

        // Share siteSetting with all Blade views
        View::composer('*', function ($view) {
            if (! $view->offsetExists('siteSetting')) {
                $view->with('siteSetting', $this->getSiteSetting());
            }
        });
    }

    protected function getSiteSetting(): Setting
    {
        try {
            if (Schema::hasTable('settings')) {
                return Setting::instance();
            }
        } catch (\Throwable $e) {
            // Database not available or tables not migrated yet
        }

        return new Setting(['site_name' => 'Portfolio CMS']);
    }
}
