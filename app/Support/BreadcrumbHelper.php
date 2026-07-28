<?php

namespace App\Support;

use Illuminate\Support\Facades\Route;

class BreadcrumbHelper
{
    /**
     * Route-based breadcrumb definitions
     */
    protected static array $routes = [
        'home' => ['title' => 'Home', 'parent' => null],
        
        // Portfolio
        'projects.index' => ['title' => 'Portfolio', 'parent' => 'home'],
        'projects.show' => ['title' => 'Project Details', 'parent' => 'projects.index'],
        
        // Blog
        'blog.index' => ['title' => 'Blog', 'parent' => 'home'],
        'blog.show' => ['title' => 'Blog Post', 'parent' => 'blog.index'],
        'blog.category' => ['title' => 'Category', 'parent' => 'blog.index'],
        'blog.categories' => ['title' => 'Categories', 'parent' => 'blog.index'],
        
        // Services
        'services.index' => ['title' => 'Services', 'parent' => 'home'],
        'services.show' => ['title' => 'Service Details', 'parent' => 'services.index'],
        
        // Pages
        'about' => ['title' => 'About', 'parent' => 'home'],
        'contact' => ['title' => 'Contact', 'parent' => 'home'],
        'quote' => ['title' => 'Get a Quote', 'parent' => 'home'],
        'thank-you' => ['title' => 'Thank You', 'parent' => 'home'],
        'privacy' => ['title' => 'Privacy Policy', 'parent' => 'home'],
        'terms' => ['title' => 'Terms of Service', 'parent' => 'home'],
        'coming-soon' => ['title' => 'Coming Soon', 'parent' => 'home'],
        'maintenance' => ['title' => 'Maintenance', 'parent' => 'home'],
        
        // Admin routes
        'admin.login' => ['title' => 'Admin Login', 'parent' => 'home'],
    ];

    /**
     * Generate breadcrumbs for current route
     */
    public static function generate(array $customItems = []): array
    {
        $breadcrumbs = [];
        $currentRoute = Route::currentRouteName();
        
        // Build route-based breadcrumbs
        if ($currentRoute && isset(self::$routes[$currentRoute])) {
            $breadcrumbs = self::buildRouteChain($currentRoute);
        }
        
        // Add custom items from controller
        if (!empty($customItems)) {
            // If we have route-based breadcrumbs, mark the last one as not active
            if (!empty($breadcrumbs)) {
                $breadcrumbs[count($breadcrumbs) - 1]['active'] = false;
            }
            
            $breadcrumbs = array_merge($breadcrumbs, $customItems);
        }
        
        return $breadcrumbs;
    }

    /**
     * Build breadcrumb chain from route
     */
    protected static function buildRouteChain(string $routeName): array
    {
        $chain = [];
        $current = $routeName;
        
        while ($current && isset(self::$routes[$current])) {
            $routeData = self::$routes[$current];
            
            $item = [
                'title' => $routeData['title'],
                'url' => route($current),
                'active' => $current === $routeName,
            ];
            
            array_unshift($chain, $item);
            $current = $routeData['parent'];
        }
        
        return $chain;
    }

    /**
     * Parse items from Blade directive
     */
    public static function parseItems(string $expression): array
    {
        if (empty($expression)) {
            return [];
        }

        // Handle array syntax: ['title' => 'Item', 'url' => '/url']
        if (str_starts_with($expression, '[')) {
            $items = json_decode($expression, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $items;
            }
            
            // Try to evaluate the expression
            try {
                $evaluated = eval('return ' . $expression . ';');
                return is_array($evaluated) ? $evaluated : [];
            } catch (\Throwable $e) {
                return [];
            }
        }

        return [];
    }

    /**
     * Add dynamic route to breadcrumb definitions
     */
    public static function addRoute(string $name, string $title, ?string $parent = 'home'): void
    {
        self::$routes[$name] = [
            'title' => $title,
            'parent' => $parent,
        ];
    }

    /**
     * Get all registered routes
     */
    public static function getRoutes(): array
    {
        return self::$routes;
    }
}
