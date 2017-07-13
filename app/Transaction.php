<?php

namespace Avem;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	public function applierPeriod()
	{
		return $this->belongsTo('Avem\ChargePeriod', 'charge_period_id');
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