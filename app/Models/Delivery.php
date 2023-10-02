<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Delivery extends Model
{
    use HasFactory;

	protected $fillable = [
		'package_id',
		'driver_id',
		'delivery_status',
		'delivery_current_location',
		'delivery_last_location',
		'delivery_code',
	];

	public function package(): BelongsTo
	{
		return $this->belongsTo(Package::class, 'package_id');
	}

	public function driver(): HasOne
	{
		return $this->hasOne(User::class, 'driver_id');
	}

	public function bus(): HasOne
	{
		return $this->hasOne(Bus::class, 'bus_id');
	}
}
