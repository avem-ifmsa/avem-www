<?php

namespace Avem;

use Illuminate\Database\Eloquent\Model;

class PerformedActivity extends Model
{
	public function activity()
	{
		return $this->belongsTo('Avem\Activity');
	}

	public function transaction()
	{
		return $this->morphOne('Avem\Transaction');
	}

	public function user()
	{
		return $this->belongsTo('Avem\User');
	}

	public function witnesserPeriod()
	{
		return $this->belongsTo('Avem\MbMemberPeriod', 'mb_member_period_id');
	}
}
