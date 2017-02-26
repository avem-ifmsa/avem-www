<?php

namespace Avem;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	public function applierPeriod()
	{
		return $this->belongsTo('Avem\MbMemberPeriod', 'mb_member_period_id');
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
