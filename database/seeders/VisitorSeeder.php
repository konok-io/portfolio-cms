<?php

namespace Database\Seeders;

use App\Models\Visitor;
use Illuminate\Database\Seeder;

class VisitorSeeder extends Seeder
{
    public function run(): void
    {
        if (Visitor::count() > 0) {
            return;
        }

        Visitor::factory()->count(120)->create();
    }
}
