<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create 10 users
        $users = User::factory()->count(10)->create();

        // Attach each user to 1-3 random courses
        $courseIds = Course::pluck('id');
        foreach ($users as $user) {
            $user->courses()->attach(
                $courseIds->random(rand(1, min(3, max(1, $courseIds->count()))))->all()
            );
        }
    }
}
