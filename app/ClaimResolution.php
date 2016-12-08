<?php

namespace App;

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
		return $this->belongsTo('App\Claim', 'id');
	}

	public function resolverPeriod()
	{
		return $this->belongsTo('App\MbMemberPeriod');
	}
}
