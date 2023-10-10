<?php

namespace Database\Factories;

use App\Models\Bus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Bus>
 */
class BusFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
    public function definition(): array
    {
		$amenities = [
				'Air Conditioner',
				'TV',
				'WiFi',
				'Toilet',
				'Reclining Seats',
				'USB Charging',
				'Snacks',
				'Drinks',
				'Blanket',
				'Pillow',
				'Reading Light',
				'Emergency Exit',
				'Smoking',
				'Handicap Accessible',
				'Luggage',
				'Pet Friendly',
				'Child Seat',
				'Wheelchair',
				'Bicycle',
				'Carry-on Baggage',
				'Over-sized Luggage',
				'Stroller',
				'Surfboard',
				'Skis',
				'Snowboard',
				'Snow Sports Equipment',
				'Water Sports Equipment',
				'Audio/Video',
				'Power Outlet',
				'Extra Legroom',
				'Meal',
				'Alcoholic Beverages',
				'Hostess',
				'Movies',
				'Air Conditioning',
				'WC',
				'Water',
				'Coffee',
				'Tea',
				'Newspaper',
				'Magazine',
				'Air Freshener',
				'Hand Sanitizer',
				'Disinfectant Wipes',
				'Disinfectant Spray',
				'Face Mask',
				'Face Shield',
				'Gloves',
				'Thermometer',
				'Hand Soap',
				'Tissues',
				'Trash Bag',
				'First Aid Kit',
				'Fire Extinguisher',
				'Defibrillator'
		];

        return [
	        'bus_name' => fake()->name(),
	        'bus_number' => fake()->unique()->numberBetween(1, 100),
	        'bus_type' => fake()->randomElement(['VIP', 'VVIP', 'STC', 'O.A', 'Metro Mass']),
	        'bus_route_from' => 'Accra',
	        'bus_route_to' => fake()->randomElement(['Kumasi', 'Tamale', 'Takoradi', 'Cape Coast', 'Koforidua']),
	        'bus_capacity' => fake()->numberBetween(1, 100),
	        'bus_route_price' => fake()->numberBetween(1, 100),
	        'bus_status' => fake()->randomElement(['Available', 'Unavailable']),
	        'bus_image' => null,
	        'bus_description' => fake()->paragraph(),
	        'bus_amenities' => $amenities,
        ];
    }
}
