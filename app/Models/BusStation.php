<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BusStation extends Model
{
    use HasFactory;

	protected $fillable = [
		'bus_station_name',
		'bus_station_city',
		'bus_station_country',
		'bus_station_address',
		'bus_station_phone_number',
		'bus_station_email',
	];

	public function buses(): HasMany
	{
		return $this->hasMany(Bus::class, 'bus_station_id', 'id');
	}

	public function departures(): HasMany
	{
		return $this->hasMany(Booking::class, 'departure_station_id', 'id');
	}

	public function arrivals(): HasMany
	{
		return $this->hasMany(Booking::class, 'arrival_station_id', 'id');
	}
}
