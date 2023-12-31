<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Package extends Model
{
    use HasFactory;

	protected $fillable = [
		'user_id', // This is the user that created the package
		'package_name',
		'package_type',
		'package_size',
		'package_description',
		'package_from',
		'package_to',
		'package_sender_name',
		'package_sender_phone',
		'package_sender_address',
		'package_receiver_name',
		'package_receiver_phone',
		'package_receiver_address',
	];

	/**
	 * Get the user that owns the package.
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function delivery(): HasOne
	{
		return $this->hasOne(Delivery::class);
	}

	public function payment(): HasOne
	{
		return $this->hasOne(Payment::class);
	}
}
