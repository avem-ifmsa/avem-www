<?php

namespace Avem;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model implements Notifiable
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'info',
	];

	public function activity()
	{
		return $this->belongsTo('Avem\Activity');
	}

	public function resolution()
	{
		return $this->hasOne('Avem\ClaimResolution');
	}

	public function user()
	{
		return $this->belongsTo('Avem\User');
	}
}
