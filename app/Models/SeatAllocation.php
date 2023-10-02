<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SeatAllocation extends Model
{
    use HasFactory;

	protected $fillable = [
		'booking_id',
		'seat_id',
		'driver_id',
		'seat_type',
	];

	public function booking(): BelongsTo
	{
		return $this->belongsTo(Booking::class);
	}

	public function seat(): BelongsTo
	{
		return $this->belongsTo(Seat::class);
	}

	public function driver(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
