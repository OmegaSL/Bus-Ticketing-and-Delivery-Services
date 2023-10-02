<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BusHistory extends Model
{
    use HasFactory;

	protected $fillable = [
		'bus_id',
		'bus_driver_id',
		'current_station_id',
		'last_station_id',
		'departure_date_time',
		'arrival_date_time',
		'departure_city',
		'arrival_city',
		'price',
		'travel_duration',
		'bus_status',
	];

	public function bus(): BelongsTo
	{
		return $this->belongsTo(Bus::class);
	}

	public function busDriver(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function currentStation(): BelongsTo
	{
		return $this->belongsTo(BusStation::class);
	}

	public function lastStation(): BelongsTo
	{
		return $this->belongsTo(BusStation::class);
	}

	public function busBookings(): HasMany
	{
		return $this->hasMany(Booking::class);
	}
}
