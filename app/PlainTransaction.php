<?php

namespace Avem;

use Illuminate\Database\Eloquent\Model;

class PlainTransaction extends Model implements Transactionable
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'concept', 'points',
	];

	public function applierPeriod()
	{
		return $this->belongsTo('Avem\MbMemberPeriod');
	}

	public function getTransactionConceptAttribute()
	{
		return $this->attributes['concept'];
	}

	public function getTransactionPeriodAttribute()
	{
		return $this->applierPeriod;
	}

	public function getTransactionPointsAttribute()
	{
		return $this->attributes['points'];
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
