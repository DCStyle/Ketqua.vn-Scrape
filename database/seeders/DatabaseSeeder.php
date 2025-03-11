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
        // First remove existing data
        \App\Models\User::truncate();

        // Create a default user
        \App\Models\User::factory()->create([
             'name' => 'Admin',
             'email' => 'admin@example.com',
             'password' => bcrypt('newpassword'),
        ]);
    }
}
