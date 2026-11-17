<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
	use HasFactory;

	protected $fillable = [
		'donor_name',
		'donor_email',
		'donor_phone',
		'amount',
		'currency',
	];

	protected $casts = [
		'amount' => 'decimal:2',
	];
}
