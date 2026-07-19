<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EducationFactory extends Factory
{
    public function definition(): array
    {
        $startYear = fake()->numberBetween(2008, 2018);

        return [
            'institute_name' => fake()->company().' University',
            'degree' => fake()->randomElement([
                'Bachelor of Science in Computer Science',
                'Master of Science in Information Technology',
                'Higher Secondary Certificate',
                'Secondary School Certificate',
            ]),
            'start_year' => (string) $startYear,
            'end_year' => (string) ($startYear + 4),
            'description' => fake()->sentence(12),
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }
}
