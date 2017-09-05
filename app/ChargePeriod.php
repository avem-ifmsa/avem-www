<?php

namespace Avem;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ChargePeriod extends Model
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

	public static function boot()
	{
		parent::boot();

		static::saving(function($chargePeriod) {
			$assignerPeriod = Auth::user()->currentChargePeriod;
			$chargePeriod->assignerPeriod()->associate($assignerPeriod);
		});
	}

	public function assignedPeriods()
	{
		return $this->hasMany('Avem\ChargePeriod');
	}

	public function assignerPeriod()
	{
		return $this->belongsTo('Avem\ChargePeriod', 'charge_period_id');
	}

	public function charge()
	{
		return $this->belongsTo('Avem\Charge');
	}

	public function getIsActiveAttribute()
	{
		return Carbon::now()->between($this->start, $this->end);
	}

	public function issuedActivityTickets()
	{
		return $this->hasMany('Avem\ActivityTicket');
	}

	public function issuedRenewals()
	{
		return $this->hasMany('Avem\Renewal');
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
		$today = Carbon::today();
		return $query->whereDate('start', '<=', $today)
		             ->whereDate('end', '>', $today);
	}

	public function sentNotifications()
	{
		return $this->hasMany('Avem\Notification');
	}

	public function user()
	{
		return $this->belongsTo('Avem\User');
	}

	public function witnessedActivities()
	{
		return $this->hasManyThrough('Avem\Activity', 'Avem\PerformedActivity');
	}

}
