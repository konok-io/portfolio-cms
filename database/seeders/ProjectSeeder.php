<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $categoryNames = ['Web Application', 'E-Commerce', 'Mobile App', 'Landing Page', 'Dashboard'];

        $categories = collect($categoryNames)->map(function ($name) {
            return ProjectCategory::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name]
            );
        });

        if (Project::count() > 0) {
            return;
        }

        $titles = [
            'Corporate Business Website',
            'Online Fashion Store',
            'Restaurant Booking App',
            'SaaS Admin Dashboard',
            'Real Estate Listing Platform',
            'Event Management System',
            'Freelancer Marketplace',
            'Inventory Management Tool',
        ];

        foreach ($titles as $index => $title) {
            Project::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'project_category_id' => $categories->random()->id,
                'client_name' => fake()->company(),
                'project_url' => 'https://example.com',
                'technologies' => 'Laravel, MySQL, Bootstrap 5, jQuery',
                'description' => '<p>'.fake()->paragraphs(4, true).'</p>',
                'status' => 'completed',
                'is_featured' => $index < 4,
                'is_active' => true,
                'sort_order' => $index,
            ]);
        }
    }
}
