<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::firstOrCreate(['id' => 1], [
            'site_name' => 'Portfolio CMS',
            'email' => 'admin@example.com',
            'phone' => '+880 1234 567890',
            'address' => 'Dhaka, Bangladesh',
            'google_map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.123!2d90.4!3d23.8!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1" width="100%" height="350" style="border:0;" allowfullscreen loading="lazy"></iframe>',
            'facebook' => 'https://facebook.com',
            'twitter' => 'https://twitter.com',
            'linkedin' => 'https://linkedin.com',
            'github' => 'https://github.com',
            'instagram' => 'https://instagram.com',
            'youtube' => 'https://youtube.com',
        ]);
    }
}
