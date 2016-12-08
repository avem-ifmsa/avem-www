<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class MbMemberPeriod extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'start', 'end',
	];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'created_at', 'updated_at', 'start', 'end',
	];

	public function appliedTransactions()
	{
		return $this->hasMany('App\Transaction');
	}

	public function charge()
	{
		return $this->belongsTo('App\Charge');
	}

	public function issuedRenewals()
	{
		return $this->hasMany('App\Renewal');
	}

	public function mbMember()
	{
		return $this->belongsTo('App\MbMember');
	}

	public function organizedActivities()
	{
		return $this->belongsToMany('App\Activity');
	}

	public function receivedClaims()
	{
		return $this->belongsToMany('App\Claim');
	}

	public function resolvedClaims()
	{
		return $this->hasMany('App\ClaimResolution');
	}

	public function scopeActive($query)
	{
		$now = Carbon::now();
		return $query->where('start', '<=', $now)
		             ->where('end', '>', $now);
	}

	public function sentNotifications()
	{
		return $this->hasMany('App\Notification');
	}
}
