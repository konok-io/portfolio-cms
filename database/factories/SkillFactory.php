<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SkillFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'PHP', 'Laravel', 'JavaScript', 'Vue.js', 'React',
                'MySQL', 'HTML5 & CSS3', 'Bootstrap', 'Tailwind CSS', 'Git',
            ]),
            'percentage' => fake()->numberBetween(60, 99),
            'icon' => 'fa-solid fa-code',
            'sort_order' => fake()->numberBetween(0, 20),
            'is_active' => true,
        ];
    }
}
