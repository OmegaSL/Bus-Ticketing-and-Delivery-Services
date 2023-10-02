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
		 \App\Models\Bus::factory(10)->create();
		 \App\Models\BusFrequency::factory(7)->create();
		 \App\Models\Seat::factory(30)->create();
		 \App\Models\Package::factory(10)->create();
		 \App\Models\Delivery::factory(10)->create();
    }
}
