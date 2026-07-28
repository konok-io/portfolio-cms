<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            ['name' => 'PHP & Laravel', 'percentage' => 95, 'icon' => 'fa-brands fa-laravel'],
            ['name' => 'JavaScript', 'percentage' => 88, 'icon' => 'fa-brands fa-js'],
            ['name' => 'Vue.js / React', 'percentage' => 85, 'icon' => 'fa-brands fa-vuejs'],
            ['name' => 'MySQL', 'percentage' => 90, 'icon' => 'fa-solid fa-database'],
            ['name' => 'HTML5 & CSS3', 'percentage' => 95, 'icon' => 'fa-brands fa-html5'],
            ['name' => 'Bootstrap / Tailwind', 'percentage' => 92, 'icon' => 'fa-brands fa-bootstrap'],
            ['name' => 'Git & GitHub', 'percentage' => 90, 'icon' => 'fa-brands fa-git-alt'],
            ['name' => 'REST API Design', 'percentage' => 87, 'icon' => 'fa-solid fa-network-wired'],
        ];

        foreach ($skills as $index => $skill) {
            Skill::firstOrCreate(
                ['name' => $skill['name']],
                [
                    'percentage' => $skill['percentage'],
                    'icon' => $skill['icon'],
                    'sort_order' => $index,
                    'is_active' => true,
                ]
            );
        }
    }
}
