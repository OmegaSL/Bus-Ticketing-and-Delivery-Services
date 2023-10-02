<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    use HasFactory;

	protected $fillable = [
		'user_id',
		'bus_id',
		'departure_station_id',
		'arrival_station_id',
		'booking_from',
		'booking_to',
		'booking_amount',
		'booking_type',
		'booking_status',
		'departure_date_time',
	];

	public function seat_allocations(): HasMany
	{
		return $this->hasMany(SeatAllocation::class);
	}

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function bus(): BelongsTo
	{
		return $this->belongsTo(Bus::class);
	}

	public function departure_station(): BelongsTo
	{
		return $this->belongsTo(BusStation::class, 'departure_station_id');
	}

	public function arrival_station(): BelongsTo
	{
		return $this->belongsTo(BusStation::class, 'arrival_station_id');
	}

	public function payment(): HasOne
	{
		return $this->hasOne(Payment::class);
	}
}
