<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienceFactory extends Factory
{
    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-8 years', '-2 years');

        return [
            'company_name' => fake()->company(),
            'designation' => fake()->jobTitle(),
            'start_date' => $start,
            'end_date' => fake()->dateTimeBetween($start, 'now'),
            'is_current' => false,
            'description' => fake()->paragraph(3),
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }

    public function current(): static
    {
        return $this->state(fn (array $attributes) => [
            'end_date' => null,
            'is_current' => true,
        ]);
    }
}
