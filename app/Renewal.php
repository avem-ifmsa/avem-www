<?php

namespace Avem;

use Illuminate\Database\Eloquent\Model;

class Renewal extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'until',
	];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'created_at', 'updated_at', 'until',
	];

	public function issuerPeriod()
	{
		return $this->belongsTo('Avem\ChargePeriod', 'charge_period_id');
	}

	public function scopeActive($query)
	{
		$query->whereDate('until', '>', Carbon::now());
	}

	public function user()
	{
		return $this->belongsTo('Avem\User');
	}
}
