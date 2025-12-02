<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\RoboticsKit;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        // If there are no kits yet, create some so foreign keys are valid
        if (RoboticsKit::count() === 0) {
            RoboticsKit::factory()->count(3)->create();
        }

        // Create courses attached to random kits
        Course::factory()->count(15)->create();
    }
}
