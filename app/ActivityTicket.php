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

	public static function saving(ActivityTicket $activityTicket)
	{
		parent::saving($activityTicket);

		$chargePeriod = Auth::user()->currentChargePeriod;
		$activityTicket->issuerPeriod()->associate($chargePeriod);
	}

	public static scopeExpired($expired = true, $query) {
		$query->whereDate('expires_at', $expired ? '<=' : '>', Carbon::now());
	}

	private static function generateRandomCode($length = 6)
	{
		$code = [];
		$charset = 'abcdefghjkmnpqrstuvwxyz23456789';
		$charsetLength = strlen($charset);
		for ($i = 0; $i < $length; ++$i) {
			$index = mt_rand(0, $charsetLength - 1);
			$code[] = $charset[$index];
		}
		return implode('', $code);
	}

	public static function generate(Activity $activity, $expiresAt, $count)
	{
		$newTickets = [];
		$oldCodes = ActivityTicket::all()->pluck('code');
		$chargePeriod = Auth::user()->currentChargePeriod;
		for ($i = 0; $i < $count; ++$i) {
			do {
				$code = static::generateRandomCode();
			} while (in_array($code, $oldCodes));
			$ticket = new ActivityTicket([
				'code' => $code, 'expires_at' => $expiresAt,
			]);
			$ticket->activity()->associate($activity);
			$ticket->issuerPeriod()->associate($chargePeriod);
			$newTickets[] = $ticket;
		}
		return $newTickets;
	}

	public static function ticketLots() {
		static::query()->groupBy(
			'activity_id', 'charge_period_id', 'created_at'
		)->get();
	}

	public function activity()
	{
		return $this->belongsTo('Avem\Activity');
	}

	public function getIsExpiredAttribute()
	{
		return Carbon::now()->ge($this->expires_at);
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
