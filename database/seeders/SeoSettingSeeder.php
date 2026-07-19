<?php

namespace Database\Seeders;

use App\Models\SeoSetting;
use Illuminate\Database\Seeder;

class SeoSettingSeeder extends Seeder
{
    public function run(): void
    {
        SeoSetting::firstOrCreate(['id' => 1], [
            'meta_title' => 'Portfolio CMS | Professional Portfolio Website',
            'meta_description' => 'A modern, professional portfolio website showcasing projects, skills, services, and blog posts.',
            'meta_keywords' => 'portfolio, developer, laravel, web development',
        ]);
    }
}
