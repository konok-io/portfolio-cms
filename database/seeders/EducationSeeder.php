<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    public function run(): void
    {
        if (Education::count() > 0) {
            return;
        }

        Education::create([
            'institute_name' => 'University of Dhaka',
            'degree' => 'Bachelor of Science in Computer Science & Engineering',
            'start_year' => '2014',
            'end_year' => '2018',
            'description' => 'Graduated with a focus on software engineering, databases, and web technologies.',
            'sort_order' => 0,
        ]);

        Education::create([
            'institute_name' => 'Notre Dame College',
            'degree' => 'Higher Secondary Certificate (Science)',
            'start_year' => '2012',
            'end_year' => '2014',
            'description' => 'Completed higher secondary education with a major in science.',
            'sort_order' => 1,
        ]);
    }
}
