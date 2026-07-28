<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    public function definition(): array
    {
        return [
            'client_name' => fake()->name(),
            'company' => fake()->company(),
            'photo' => null,
            'rating' => fake()->numberBetween(4, 5),
            'review' => fake()->paragraph(4),
            'is_active' => true,
            'sort_order' => fake()->numberBetween(0, 20),
        ];
    }
}
