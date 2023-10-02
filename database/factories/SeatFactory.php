<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seat>
 */
class SeatFactory extends Factory
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
	        'seat_number' => $this->faker->randomElement(['A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'B1', 'B2', 'B3', 'B4', 'B5', 'B6', 'B7']),
	        'seat_type' => $this->faker->randomElement(['Economy', 'Business', 'First Class']),
	        'seat_status' => $this->faker->randomElement(['Available', 'Booked', 'Blocked']),
        ];
    }
}
