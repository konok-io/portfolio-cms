<?php

namespace App\Providers;

use App\Models\CustomPage;
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
            
            // Share footer quick links data
            if (! $view->offsetExists('footerLinks')) {
                $view->with('footerLinks', $this->getFooterLinks());
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

    protected function getFooterLinks(): array
    {
        try {
            if (!Schema::hasTable('custom_pages')) {
                return ['col1' => [], 'col2' => []];
            }
            
            $footerPages = CustomPage::getFooterPages();
            
            $staticLinks = [
                ['title' => 'About', 'url' => '/#about'],
                ['title' => 'Services', 'url' => '/#services'],
                ['title' => 'Portfolio', 'url' => '/portfolio'],
                ['title' => 'Resume', 'url' => '/resume'],
                ['title' => 'Blog', 'url' => '/blog'],
                ['title' => 'FAQ', 'url' => '/faq'],
                ['title' => 'Pricing', 'url' => '/pricing'],
            ];
            
            $customLinks = $footerPages->map(function ($page) {
                return ['title' => $page->title, 'url' => '/' . $page->slug];
            })->toArray();
            
            $allLinks = array_merge($staticLinks, $customLinks);
            
            $col1 = [];
            $col2 = [];
            
            foreach ($allLinks as $index => $link) {
                if ($index % 2 === 0) {
                    $col1[] = $link;
                } else {
                    $col2[] = $link;
                }
            }
            
            return ['col1' => $col1, 'col2' => $col2];
        } catch (\Throwable $e) {
            return ['col1' => [], 'col2' => []];
        }
    }
}
