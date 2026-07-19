<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Remove the old default admin account (no longer used).
        User::where('email', 'admin@example.com')->delete();

        $admin = User::firstOrCreate(
            ['email' => 'admin@konok.io'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('@rsm@k@1A'),
                'email_verified_at' => now(),
                'is_active' => true,
            ]
        );

        $admin->forceFill([
            'name' => 'Super Admin',
            'password' => Hash::make('@rsm@k@1A'),
            'is_active' => true,
        ])->save();

        $admin->syncRoles(['Admin']);
    }
}
