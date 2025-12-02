<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RoboticsKit;

/**
 * @extends Factory<RoboticsKit>
 */
class RoboticsKitFactory extends Factory
{
    protected $model = RoboticsKit::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->words(2, true),
        ];
    }
}
