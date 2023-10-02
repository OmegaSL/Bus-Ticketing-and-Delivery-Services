<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seat extends Model
{
    use HasFactory;

	protected $fillable = [
		'bus_id',
		'seat_number',
		'seat_type',
		'seat_status',
	];

	public function bus(): BelongsTo
	{
		return $this->belongsTo(Bus::class);
	}

	public function scopeAvailable($query)
	{
		return $query->where('seat_status', 'Available');
	}

	public function scopeBooked($query)
	{
		return $query->where('seat_status', 'Booked');
	}

	public function scopeBlocked($query)
	{
		return $query->where('seat_status', 'Blocked');
	}
}
