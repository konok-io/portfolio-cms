<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $categoryNames = ['Web Development', 'Laravel Tips', 'Career Advice', 'Tutorials'];

        $categories = collect($categoryNames)->map(function ($name) {
            return BlogCategory::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name]
            );
        });

        if (Blog::count() > 0) {
            return;
        }

        $admin = User::where('email', 'admin@example.com')->first();

        $titles = [
            'Getting Started with Laravel 12',
            '5 Tips to Write Cleaner PHP Code',
            'Why I Switched to Tailwind CSS',
            'Building REST APIs the Right Way',
            'How to Stay Productive as a Freelance Developer',
            'Understanding Laravel Service Providers',
        ];

        foreach ($titles as $index => $title) {
            Blog::create([
                'user_id' => $admin?->id,
                'blog_category_id' => $categories->random()->id,
                'title' => $title,
                'slug' => Str::slug($title),
                'short_description' => fake()->sentence(20),
                'description' => '<p>'.fake()->paragraphs(6, true).'</p>',
                'meta_title' => $title,
                'meta_keywords' => 'laravel, php, web development',
                'meta_description' => fake()->sentence(15),
                'status' => 'published',
                'views' => fake()->numberBetween(10, 500),
                'published_at' => now()->subDays($index * 3),
            ]);
        }
    }
}
