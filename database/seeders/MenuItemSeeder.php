<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        // Header Menu
        $headerItems = [
            ['name' => 'Home', 'route' => 'home', 'url' => '/', 'icon' => 'fa-solid fa-home', 'order' => 1, 'menu_type' => 'header', 'is_active' => true],
            ['name' => 'About', 'route' => 'about', 'url' => '/about', 'icon' => 'fa-solid fa-user', 'order' => 2, 'menu_type' => 'header', 'is_active' => true],
            ['name' => 'Services', 'route' => 'services', 'url' => '/services', 'icon' => 'fa-solid fa-briefcase', 'order' => 3, 'menu_type' => 'header', 'is_active' => true],
            ['name' => 'Portfolio', 'route' => 'projects.index', 'url' => '/portfolio', 'icon' => 'fa-solid fa-folder-open', 'order' => 4, 'menu_type' => 'header', 'is_active' => true],
            ['name' => 'Blog', 'route' => 'blog.index', 'url' => '/blog', 'icon' => 'fa-solid fa-blog', 'order' => 5, 'menu_type' => 'header', 'is_active' => true],
            ['name' => 'Contact', 'route' => 'contact', 'url' => '/contact', 'icon' => 'fa-solid fa-envelope', 'order' => 6, 'menu_type' => 'header', 'is_active' => true],
        ];

        // Footer Menu
        $footerItems = [
            ['name' => 'FAQ', 'route' => 'faq', 'url' => '/faq', 'icon' => 'fa-solid fa-question', 'order' => 1, 'menu_type' => 'footer', 'is_active' => true],
            ['name' => 'Pricing', 'route' => 'pricing', 'url' => '/pricing', 'icon' => 'fa-solid fa-tags', 'order' => 2, 'menu_type' => 'footer', 'is_active' => true],
            ['name' => 'Privacy Policy', 'route' => 'privacy', 'url' => '/privacy', 'icon' => 'fa-solid fa-shield-halved', 'order' => 3, 'menu_type' => 'footer', 'is_active' => true],
            ['name' => 'Terms of Service', 'route' => 'terms', 'url' => '/terms', 'icon' => 'fa-solid fa-file-contract', 'order' => 4, 'menu_type' => 'footer', 'is_active' => true],
            ['name' => 'Resume', 'route' => 'resume', 'url' => '/resume', 'icon' => 'fa-solid fa-file-pdf', 'order' => 5, 'menu_type' => 'footer', 'is_active' => true],
        ];

        $allItems = array_merge($headerItems, $footerItems);

        foreach ($allItems as $item) {
            MenuItem::firstOrCreate(
                ['name' => $item['name']],
                $item
            );
        }
    }
}
