<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BusFrequency>
 */
class BusFrequencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
		$buses = \App\Models\Bus::all()->pluck('id')->toArray();

        return [
	        'bus_id' => $this->faker->randomElement($buses),
	        'day' => $this->faker->unique()->randomElement(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']),
        ];
    }
}
