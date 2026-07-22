<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['name' => 'Home', 'route' => 'home', 'icon' => 'fa-solid fa-home', 'order' => 1],
            ['name' => 'About', 'route' => 'about', 'icon' => 'fa-solid fa-user', 'order' => 2],
            ['name' => 'Services', 'route' => 'services', 'icon' => 'fa-solid fa-briefcase', 'order' => 3],
            ['name' => 'Portfolio', 'route' => 'projects.index', 'icon' => 'fa-solid fa-folder-open', 'order' => 4],
            ['name' => 'Blog', 'route' => 'blog.index', 'icon' => 'fa-solid fa-blog', 'order' => 5],
            ['name' => 'Contact', 'route' => 'contact', 'icon' => 'fa-solid fa-envelope', 'order' => 6],
        ];

        foreach ($items as $item) {
            MenuItem::firstOrCreate(
                ['name' => $item['name']],
                $item
            );
        }
    }
}
