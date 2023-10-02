<?php

namespace Database\Factories;

use App\Models\Delivery;
use App\Models\Package;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Delivery>
 */
class DeliveryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
		$packages = Package::all()->pluck('id')->toArray();
		$drivers = User::where('id', '!=', 1)->get()->pluck('id')->toArray();

        return [
	        'package_id' => $this->faker->randomElement($packages),
	        'driver_id' => $this->faker->randomElement($drivers),
	        'delivery_status' => $this->faker->randomElement(['pending', 'processing', 'delivered', 'cancelled']),
	        'delivery_current_location' => $this->faker->city(),
	        'delivery_last_location' => $this->faker->city(),
	        'delivery_code' => $this->faker->randomNumber(6),
        ];
    }
}
