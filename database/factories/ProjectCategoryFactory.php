<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProjectCategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Web Application', 'Mobile App', 'E-Commerce', 'Landing Page',
            'WordPress', 'API Project', 'Dashboard',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
