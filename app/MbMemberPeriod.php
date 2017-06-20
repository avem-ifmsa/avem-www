<?php

namespace Avem;

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
		return $this->hasMany('Avem\Transaction');
	}

	public function charge()
	{
		return $this->belongsTo('Avem\Charge');
	}

	public function issuedRenewals()
	{
		return $this->hasMany('Avem\Renewal');
	}

	public function mbMember()
	{
		return $this->belongsTo('Avem\MbMember');
	}

	public function organizedActivities()
	{
		return $this->belongsToMany('Avem\Activity');
	}

	public function publishedExchanges()
	{
		return $this->hasMany('Avem\Exchange');
	}

	public function receivedClaims()
	{
		return $this->belongsToMany('Avem\Claim');
	}

	public function resolvedClaims()
	{
		return $this->hasMany('Avem\ClaimResolution');
	}

	public function scopeActive($query)
	{
		$now = Carbon::now();
		return $query->where('start', '<=', $now)
		             ->where('end', '>', $now);
	}

	public function sentNotifications()
	{
		return $this->hasMany('Avem\Notification');
	}

	public function witnessedActivities()
	{
		return $this->hasManyThrough('Avem\Activity', 'Avem\MbMemberPeriod');
	}
}
