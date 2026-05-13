<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin default (untuk login dashboard admin)
        // updateOrCreate supaya tidak membuat duplikat saat seed berkali-kali
        User::updateOrCreate(
            ['email' => 'adminpirime99@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('Admin12399'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // User::factory(10)->create();
    }
}

