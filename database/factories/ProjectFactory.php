<?php

namespace Database\Factories;

use App\Models\ProjectCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProjectFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->catchPhrase();

        return [
            'title' => $title,
            'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(1, 100000),
            'project_category_id' => ProjectCategory::inRandomOrder()->value('id'),
            'featured_image' => null,
            'client_name' => fake()->company(),
            'project_url' => fake()->url(),
            'technologies' => implode(', ', fake()->randomElements(
                ['Laravel', 'Vue.js', 'React', 'MySQL', 'Bootstrap', 'Tailwind CSS', 'Node.js'],
                3
            )),
            'description' => fake()->paragraphs(3, true),
            'status' => fake()->randomElement(['completed', 'ongoing', 'on_hold']),
            'is_featured' => fake()->boolean(30),
            'is_active' => true,
            'sort_order' => fake()->numberBetween(0, 30),
        ];
    }
}
