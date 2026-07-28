<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SeedDemoData extends Command
{
    protected $signature = 'db:demo {--fresh : Drop all tables and re-seed}';
    protected $description = 'Seed the database with demo data for the portfolio CMS';

    public function handle(): int
    {
        $this->info('Seeding demo data...');

        if ($this->option('fresh')) {
            if ($this->confirm('This will delete ALL existing data. Are you sure?')) {
                $this->call('migrate:fresh');
                $this->info('Database refreshed.');
            } else {
                $this->info('Operation cancelled.');
                return Command::SUCCESS;
            }
        }

        $this->info('Running seeders...');

        // Core seeders
        $this->call('db:seed', ['--class' => 'Database\Seeders\RolesAndPermissionsSeeder']);
        $this->call('db:seed', ['--class' => 'Database\Seeders\AdminUserSeeder']);
        $this->call('db:seed', ['--class' => 'Database\Seeders\AboutSeeder']);
        $this->call('db:seed', ['--class' => 'Database\Seeders\SettingSeeder']);
        $this->call('db:seed', ['--class' => 'Database\Seeders\SeoSettingSeeder']);
        $this->call('db:seed', ['--class' => 'Database\Seeders\PageContentSeeder']);
        $this->call('db:seed', ['--class' => 'Database\Seeders\SkillSeeder']);
        $this->call('db:seed', ['--class' => 'Database\Seeders\ServiceSeeder']);
        $this->call('db:seed', ['--class' => 'Database\Seeders\ExperienceSeeder']);
        $this->call('db:seed', ['--class' => 'Database\Seeders\EducationSeeder']);
        $this->call('db:seed', ['--class' => 'Database\Seeders\ProjectSeeder']);
        $this->call('db:seed', ['--class' => 'Database\Seeders\BlogSeeder']);
        $this->call('db:seed', ['--class' => 'Database\Seeders\TestimonialSeeder']);
        $this->call('db:seed', ['--class' => 'Database\Seeders\NewFeaturesSeeder']);
        $this->call('db:seed', ['--class' => 'Database\Seeders\MenuItemSeeder']);

        $this->newLine();
        $this->info('✅ Demo data seeded successfully!');
        $this->info('');
        $this->info('Admin Login:');
        $this->info('  Email: admin@example.com');
        $this->info('  Password: password');
        $this->info('');
        $this->info('Run: php artisan optimize:clear');

        return Command::SUCCESS;
    }
}
