<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogCategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Web Development', 'Laravel Tips', 'JavaScript', 'Career Advice',
            'Tutorials', 'News', 'Design',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
