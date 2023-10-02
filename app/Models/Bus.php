<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bus extends Model
{
    use HasFactory;

	protected $fillable = [
		'bus_name',
		'bus_number',
		'bus_type',
		'bus_route_from',
		'bus_route_to',
		'bus_capacity',
		'bus_status',
		'bus_route_price',
		'bus_image',
		'bus_description',
		'bus_amenities',
	];

	protected $casts = [
		'bus_amenities' => 'array',
	];

	public function bus_histories(): HasMany
	{
		return $this->hasMany(BusHistory::class);
	}

	public function bookings(): HasMany
	{
		return $this->hasMany(Booking::class);
	}

	public function seats(): HasMany
	{
		return $this->hasMany(Seat::class);
	}

	public function busFrequencies(): HasMany
	{
		return $this->hasMany(BusFrequency::class);
	}
}
