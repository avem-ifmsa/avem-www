<?php

namespace Avem;

use Auth;
use Illuminate\Database\Eloquent\Model;

class PlainTransaction extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'concept', 'points',
	];

	public static function saving(PlainTransaction $plainTransaction)
	{
		parent::saving($plainTransaction);

		$chargePeriod = Auth::user()->currentChargePeriod;
		$plainTransaction->applierPeriod()->associate($chargePeriod);
	}

	public function applierPeriod()
	{
		return $this->belongsTo('Avem\ChargePeriod', 'charge_period_id');
	}

	public function transaction()
	{
		return $this->morphOne('Avem\Transaction');
	}

	public function user()
	{
		return $this->belongsTo('Avem\User');
	}
}
