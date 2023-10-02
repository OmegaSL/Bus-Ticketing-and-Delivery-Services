<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
	        'package_name' => $this->faker->name(),
	        'package_type' => $this->faker->randomElement(['Document', 'Parcel', 'Food', 'Clothes', 'Electronics', 'Others']),
	        'package_size' => $this->faker->randomElement(['small', 'medium', 'large']),
	        'package_description' => $this->faker->text(),
	        'package_from' => $this->faker->city(),
	        'package_to' => $this->faker->city(),
	        'package_sender_name' => $this->faker->name(),
	        'package_sender_phone' => $this->faker->phoneNumber(),
	        'package_sender_address' => $this->faker->address(),
	        'package_receiver_name' => $this->faker->name(),
	        'package_receiver_phone' => $this->faker->phoneNumber(),
	        'package_receiver_address' => $this->faker->address(),
        ];
    }
}
