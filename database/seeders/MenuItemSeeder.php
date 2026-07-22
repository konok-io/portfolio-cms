<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['title' => 'Home', 'route' => 'home', 'url' => '/', 'icon' => 'fa-solid fa-home', 'position' => 1],
            ['title' => 'About', 'route' => 'about', 'url' => '/about', 'icon' => 'fa-solid fa-user', 'position' => 2],
            ['title' => 'Services', 'route' => 'services', 'url' => '/services', 'icon' => 'fa-solid fa-briefcase', 'position' => 3],
            ['title' => 'Portfolio', 'route' => 'projects.index', 'url' => '/portfolio', 'icon' => 'fa-solid fa-folder-open', 'position' => 4],
            ['title' => 'Blog', 'route' => 'blog.index', 'url' => '/blog', 'icon' => 'fa-solid fa-blog', 'position' => 5],
            ['title' => 'Contact', 'route' => 'contact', 'url' => '/contact', 'icon' => 'fa-solid fa-envelope', 'position' => 6],
        ];

        foreach ($items as $item) {
            MenuItem::firstOrCreate(
                ['title' => $item['title']],
                $item
            );
        }
    }
}
