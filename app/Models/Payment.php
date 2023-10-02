<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

	protected $fillable = [
		'booking_id',
		'package_id',
		'payment_method',
		'payment_status',
		'payment_amount',
		'payment_currency',
		'payment_id',
	];

	public function booking(): BelongsTo
	{
		return $this->belongsTo(Booking::class);
	}

	public function package(): BelongsTo
	{
		return $this->belongsTo(Package::class);
	}
}
