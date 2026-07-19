<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VisitorFactory extends Factory
{
    public function definition(): array
    {
        return [
            'ip_address' => fake()->ipv4(),
            'browser' => fake()->randomElement(['Chrome', 'Firefox', 'Safari', 'Edge', 'Opera']),
            'platform' => fake()->randomElement(['Windows', 'macOS', 'Android', 'iOS', 'Linux']),
            'device' => fake()->randomElement(['Desktop', 'Mobile', 'Tablet']),
            'country' => fake()->countryCode(),
            'page_url' => '/',
            'visited_date' => fake()->dateTimeBetween('-14 days', 'now')->format('Y-m-d'),
        ];
    }
}
