<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    public function run(): void
    {
        About::firstOrCreate(['id' => 1], [
            'name' => 'John Doe',
            'title' => 'Full Stack Web Developer',
            'short_intro' => 'I build modern, scalable web applications using Laravel, Vue, and React.',
            'description' => 'I am a passionate full stack developer with several years of experience designing, building, and maintaining web applications. I specialize in Laravel-based backends paired with modern, responsive front-ends, and I enjoy turning complex requirements into clean, maintainable code.',
            'address' => 'Dhaka, Bangladesh',
            'phone' => '+880 1234 567890',
            'email' => 'admin@example.com',
            'linkedin' => 'https://linkedin.com',
            'github' => 'https://github.com',
            'facebook' => 'https://facebook.com',
            'twitter' => 'https://twitter.com',
            'instagram' => 'https://instagram.com',
        ]);
    }
}
