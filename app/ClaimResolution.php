<?php

namespace Avem;

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

	public function claim()
	{
		return $this->belongsTo('Avem\Claim');
	}

	public function resolverPeriod()
	{
		return $this->belongsTo('Avem\MbMemberPeriod');
	}
}
