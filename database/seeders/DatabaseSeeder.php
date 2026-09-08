<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create();

        User::factory()->create([
            'username' => 'Murphy',
            'username' => 'murphy_dev',
            'email' => 'murphy@example.com',
            'phone_number' => '09120000000',
            'password' => bcrypt('password123'),
        ]);
    }
}
