<?php

namespace Avem;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Renewal extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'issued_at', 'until',
	];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'created_at', 'updated_at', 'issued_at', 'until',
	];

	public function issuerPeriod()
	{
		return $this->belongsTo('Avem\MbMemberPeriod');
	}

	public function scopeActive($query)
	{
		$query->where('until', '>', Carbon::now());
	}

	public function user()
	{
		return $this->belongsTo('Avem\User');
	}
}
