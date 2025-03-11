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
        // Disable foreign key checks
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        \App\Models\User::truncate();

        // Enable foreign key checks
        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Create a default user
        \App\Models\User::factory()->create([
             'name' => 'Admin',
             'email' => 'admin@example.com',
             'password' => bcrypt('newpassword'),
        ]);
    }
}
