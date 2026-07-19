<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            AdminUserSeeder::class,
            AboutSeeder::class,
            SettingSeeder::class,
            SeoSettingSeeder::class,
            SkillSeeder::class,
            ServiceSeeder::class,
            ExperienceSeeder::class,
            EducationSeeder::class,
            ProjectSeeder::class,
            BlogSeeder::class,
            TestimonialSeeder::class,
            ContactMessageSeeder::class,
            VisitorSeeder::class,
        ]);
    }
}
