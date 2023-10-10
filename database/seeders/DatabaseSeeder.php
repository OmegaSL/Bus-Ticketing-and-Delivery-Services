<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
	    $this->call([
		    BusStationSeeder::class,
	    ]);

	     \App\Models\User::create([
	         'name' => 'Super Admin',
			 'first_name' => 'Super',
			 'last_name' => 'Admin',
	         'email' => 'admin@admin.com',
             'phone_number' => '1234567890',
		     'city' => 'Koforidua',
             'address' => 'Srudae, Koforidua',
	         'email_verified_at' => now(),
	         'password' => bcrypt('password'),
	         'remember_token' => Str::random(10),
	     ]);
         \App\Models\User::factory(10)->create();
		 \App\Models\Bus::factory(20)->create();
		 \App\Models\BusFrequency::factory(7)->create();
		 \App\Models\Seat::factory(30)->create();
		 \App\Models\Package::factory(10)->create();
		 \App\Models\Delivery::factory(10)->create();

		 foreach (\App\Models\Bus::all() as $bus) {
			 \App\Models\BusHistory::create([
				 'bus_id' => $bus->id,
				 'bus_driver_id' => \App\Models\User::query()->inRandomOrder()->first()->id,
				 'current_station_id' => \App\Models\BusStation::query()->inRandomOrder()->first()->id,
				 'last_station_id' => \App\Models\BusStation::query()->inRandomOrder()->first()->id,
				 'departure_date_time' => now(),
				 'arrival_date_time' => now()->addHours(5),
				 'departure_city' => 'Koforidua',
				 'arrival_city' => 'Accra',
				 'price' => $bus->bus_route_price,
				 'travel_duration' => 5,
				 'bus_status' => 'available',
			 ]);
		 }
    }
}
