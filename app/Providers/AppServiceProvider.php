<?php

namespace App\Providers;

use App\Helpers\TranslationHelper;
use App\Models\About;
use App\Models\CustomPage;
use App\Models\MenuItem;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Blade;

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

            // Share menu items for front navbar
            if (! $view->offsetExists('menuItems')) {
                $view->with('menuItems', $this->getMenuItems());
            }

            // Share about data for SEO structured data
            if (! $view->offsetExists('about')) {
                $view->with('about', $this->getAbout());
            }
        });
        
        // Image Optimization Blade Directives
        Blade::directive('optimizeImage', function ($expression) {
            $args = collect(explode(',', $expression))->map(fn($arg) => trim($arg, " \t\n\r\0\x0B'\""));
            
            $src = $args->get(0, '');
            $alt = $args->get(1, '');
            $class = $args->get(2, '');
            $lazy = $args->get(3, 'true');
            
            $lazyAttr = $lazy === 'true' ? ' loading="lazy"' : '';
            $classAttr = $class ? ' class="' . $class . '"' : '';
            
            return "<img src=\"{$src}\" alt=\"{$alt}\"{$classAttr}{$lazyAttr}>";
        });
        
        Blade::directive('responsiveImage', function ($expression) {
            $args = collect(explode(',', $expression))->map(fn($arg) => trim($arg, " \t\n\r\0\x0B'\""));
            
            $src = $args->get(0, '');
            $alt = $args->get(1, '');
            $class = $args->get(2, '');
            $sizes = $args->get(3, '100vw');
            
            // Generate srcset for different widths (if using an image CDN or media library)
            $widths = [320, 640, 960, 1280, 1920];
            $srcset = collect($widths)->map(function ($w) use ($src) {
                // This assumes an image CDN that supports width parameter
                // Replace with your actual image processing URL pattern
                $processedSrc = $src . (str_contains($src, '?') ? '&' : '?') . "w={$w}";
                return "{$processedSrc} {$w}w";
            })->implode(', ');
            
            $classAttr = $class ? ' class="' . $class . '"' : '';
            
            return "<img src=\"{$src}\" srcset=\"{$srcset}\" sizes=\"{$sizes}\" alt=\"{$alt}\"{$classAttr} loading=\"lazy\">";
        });
        
        // Breadcrumb Helper Directive
        Blade::directive('breadcrumbs', function ($expression) {
            // Parse the expression - can be empty or an array of items
            $items = $expression ? "App\Support\BreadcrumbHelper::parseItems({$expression})" : '[]';
            
            return "<?php
                \$__breadcrumbs = App\Support\BreadcrumbHelper::generate({$items});
                echo view('front.components.breadcrumb', ['items' => \$__breadcrumbs])->render();
            ?>";
        });
        
        // Translation Directives
        Blade::directive('trans', function ($expression) {
            return "<?php echo App\Helpers\TranslationHelper::get({$expression}); ?>";
        });
        
        Blade::directive('currentLocale', function () {
            return "<?php echo App\Helpers\TranslationHelper::getCurrentLocale(); ?>";
        });
        
        Blade::directive('isRtl', function () {
            return "<?php echo App\Helpers\TranslationHelper::isRtl() ? 'dir=\"rtl\"' : ''; ?>";
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
                ['title' => 'Login', 'url' => route('admin.login')],
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

    protected function getMenuItems()
    {
        try {
            if (!Schema::hasTable('menu_items')) {
                return collect([]);
            }
            // Get hierarchical menu items (top level with children)
            return MenuItem::active()
                ->whereNull('parent_id')
                ->orderBy('order')
                ->with(['children' => function ($query) {
                    $query->active()->orderBy('sort_order');
                }])
                ->get();
        } catch (\Throwable $e) {
            return collect([]);
        }
    }

    protected function getAbout()
    {
        try {
            if (!Schema::hasTable('abouts')) {
                return null;
            }
            return About::first();
        } catch (\Throwable $e) {
            return null;
        }
    }
}
