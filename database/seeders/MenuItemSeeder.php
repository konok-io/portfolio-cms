<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['title' => 'Home', 'route' => 'home', 'icon' => 'fa-solid fa-home', 'order' => 1],
            ['title' => 'About', 'route' => 'about', 'icon' => 'fa-solid fa-user', 'order' => 2],
            ['title' => 'Services', 'route' => 'services', 'icon' => 'fa-solid fa-briefcase', 'order' => 3],
            ['title' => 'Portfolio', 'route' => 'projects.index', 'icon' => 'fa-solid fa-folder-open', 'order' => 4],
            ['title' => 'Blog', 'route' => 'blog.index', 'icon' => 'fa-solid fa-blog', 'order' => 5],
            ['title' => 'Contact', 'route' => 'contact', 'icon' => 'fa-solid fa-envelope', 'order' => 6],
        ];

        foreach ($items as $item) {
            MenuItem::firstOrCreate(
                ['title' => $item['title']],
                $item
            );
        }
    }
}
