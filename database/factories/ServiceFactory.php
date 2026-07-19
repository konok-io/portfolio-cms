<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Web Development', 'UI/UX Design', 'API Development',
                'SEO Optimization', 'Mobile App Development', 'Cloud Deployment',
            ]),
            'icon' => 'fa-solid fa-laptop-code',
            'description' => fake()->sentence(15),
            'sort_order' => fake()->numberBetween(0, 20),
            'is_active' => true,
        ];
    }
}
