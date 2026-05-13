<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin default (untuk login dashboard admin)
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'adminpirime99@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('Admin12399'),
            'role' => 'admin',
        ]);

        // User::factory(10)->create();
    }
}
