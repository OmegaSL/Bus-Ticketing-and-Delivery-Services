<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusStationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::insert('INSERT INTO bus_stations (bus_station_name, bus_station_city, bus_station_country, bus_station_address, bus_station_phone_number, bus_station_email) VALUES (?, ?, ?, ?, ?, ?)', [
			'VIP Bus Station 1',
			'Accra',
			'Ghana',
			'Accra, Ghana',
			'1234567890',
			'bus@station1.com',
        ]);

		DB::insert('INSERT INTO bus_stations (bus_station_name, bus_station_city, bus_station_country, bus_station_address, bus_station_phone_number, bus_station_email) VALUES (?, ?, ?, ?, ?, ?)', [
			'VIP Bus Station 2',
			'Kumasi',
			'Ghana',
			'Kumasi, Ghana',
			'1234567890',
			'bus@station2.com',
		]);

		DB::insert('INSERT INTO bus_stations (bus_station_name, bus_station_city, bus_station_country, bus_station_address, bus_station_phone_number, bus_station_email) VALUES (?, ?, ?, ?, ?, ?)', [
			'VIP Bus Station 3',
			'Tamale',
			'Ghana',
			'Tamale, Ghana',
			'1234567890',
			'bus@station2.com',
		]);

		DB::insert('INSERT INTO bus_stations (bus_station_name, bus_station_city, bus_station_country, bus_station_address, bus_station_phone_number, bus_station_email) VALUES (?, ?, ?, ?, ?, ?)', [
			'VIP Bus Station 4',
			'Takoradi',
			'Ghana',
			'Takoradi, Ghana',
			'1234567890',
			'bus@station3.com',
		]);
    }
}
