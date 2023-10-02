<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BusFrequency extends Model
{
    use HasFactory;

	protected $fillable = [
		'bus_id',
		'day',
	];

	public function bus(): BelongsTo
	{
		return $this->belongsTo(Bus::class);
	}
}
