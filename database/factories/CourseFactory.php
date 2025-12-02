<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Course;
use App\Models\RoboticsKit;

/**
 * @extends Factory<Course>
 */
class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        return [
            'code' => strtoupper($this->faker->unique()->bothify('CS###')),
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->optional()->paragraph(),
            'credits' => $this->faker->numberBetween(1, 6),
            'semester' => $this->faker->randomElement(['Spring','Summer','Fall','Winter']),
            'robotics_kit_id' => RoboticsKit::factory(),
        ];
    }
}
