<?php

namespace Avem;

use Auth;
use Illuminate\Database\Eloquent\Model;

class ClaimResolution extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'status',
	];

	public static function saving(ClaimResolution $claimResolution)
	{
		parent::saving($claimResolution);

		$currentPeriod = Auth::user()->currentPeriod;
		$claimResolution->resolverPeriod()->associate($currentPeriod);
	}

	public function claim()
	{
		return $this->belongsTo('Avem\Claim');
	}

	public function resolverPeriod()
	{
		return $this->belongsTo('Avem\ChargePeriod', 'charge_period_id');
	}
}
