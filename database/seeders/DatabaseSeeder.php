<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed a specific user
        User::factory()->create([
            'name' => 'Richard',
            'email' => 'richard@gmail.com',
            'password' => Hash::make('123456'),
        ]);

        // Run the rest of the seeders
        $this->call([
            RoboticsKitSeeder::class,
            CourseSeeder::class,
            UserSeeder::class,
        ]);
    }
}
