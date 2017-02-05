<?php

namespace Avem;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'applied_at',
	];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'created_at', 'updated_at', 'applied_at',
	];

	public function applierPeriod()
	{
		return $this->belongsTo('Avem\MbMemberPeriod');
	}

	public function transactionable()
	{
		return $this->morphTo();
	}

	public function user()
	{
		return $this->belongsTo('Avem\User');
	}
}
