<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Seeder;

class ContactMessageSeeder extends Seeder
{
    public function run(): void
    {
        if (ContactMessage::count() > 0) {
            return;
        }

        ContactMessage::factory()->count(8)->create();
    }
}
