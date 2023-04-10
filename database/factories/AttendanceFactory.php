<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1,112),
            'date' => $this->faker->dateTimeBetween($startDate = '-3 days', $endDate = 'now')->format('Y-m-d'),
            'start_time' => $this->faker->time(),
            'end_time' => $this->faker->time()
        ];
    }
}
