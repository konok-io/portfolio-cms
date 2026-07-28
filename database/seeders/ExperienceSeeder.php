<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        if (Experience::count() > 0) {
            return;
        }

        Experience::factory()->current()->create([
            'company_name' => 'Tech Solutions Ltd.',
            'designation' => 'Senior Laravel Developer',
            'start_date' => now()->subYears(2),
            'sort_order' => 0,
        ]);

        Experience::factory()->create([
            'company_name' => 'Creative Agency',
            'designation' => 'Full Stack Developer',
            'start_date' => now()->subYears(5),
            'end_date' => now()->subYears(2)->subDay(),
            'sort_order' => 1,
        ]);

        Experience::factory()->create([
            'company_name' => 'StartUp Hub',
            'designation' => 'Junior Web Developer',
            'start_date' => now()->subYears(7),
            'end_date' => now()->subYears(5)->subDay(),
            'sort_order' => 2,
        ]);
    }
}
