<?php

namespace Database\Factories;

use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(6);

        return [
            'user_id' => User::inRandomOrder()->value('id'),
            'blog_category_id' => BlogCategory::inRandomOrder()->value('id'),
            'title' => rtrim($title, '.'),
            'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(1, 100000),
            'featured_image' => null,
            'short_description' => fake()->sentence(20),
            'description' => '<p>'.implode('</p><p>', fake()->paragraphs(5)).'</p>',
            'meta_title' => $title,
            'meta_keywords' => implode(', ', fake()->words(5)),
            'meta_description' => fake()->sentence(15),
            'status' => 'published',
            'views' => fake()->numberBetween(0, 500),
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }

    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'draft',
            'published_at' => null,
        ]);
    }
}
