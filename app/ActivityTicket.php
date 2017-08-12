<?php

namespace Avem;

use Auth;
use Avem\Activity;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ActivityTicket extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'code', 'expires_at',
	];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'created_at', 'updated_at', 'exchanged_at', 'expires_at',
	];

	public static function saving($activityTicket)
	{
		parent::saving($activityTicket);

		$chargePeriod = Auth::user()->currentChargePeriod;
		$activityTicket->issuerPeriod()->associate($chargePeriod);
	}

	public static function scopeExpired($query, $expired = true)
	{
		$query->whereDate('expires_at', $expired ? '<=' : '>', Carbon::now());
	}

	public static function scopeExchanged($query, $exchanged = true)
	{
		$exchanged
			? $query->whereNotNull('performed_activity_id')
			: $query->where('performed_activity_id', null);
	}

	public static function scopeFromTicketLot($query, $ticketLot)
	{
		$query->where('activity_id', $ticketLot->activity_id)
		      ->where('charge_period_id', $ticketLot->charge_period_id)
		      ->where('created_at', $ticketLot->created_at)
		      ->where('expires_at', $ticketLot->expires_at);
	}

	public function activity()
	{
		return $this->belongsTo('Avem\Activity');
	}

	public function getIsExpiredAttribute()
	{
		return Carbon::now()->gt($this->expires_at);
	}

	public function getExchangedAtAttribute()
	{
		return $this->isExchanged ? $this->performedActivity->created_at : null;
	}

	public function getExchangedByAttribute()
	{
		return $this->isExchanged ? $this->performedActivity->user : null;
	}

	public function getIsExchangedAttribute()
	{
		return $this->performed_activity_id == null;
	}

	public function issuerPeriod()
	{
		return $this->belongsTo('Avem\ChargePeriod', 'charge_period_id');
	}

	public function performedActivity()
	{
		return $this->belongsTo('Avem\PerformedActivity');
	}
}
