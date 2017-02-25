<?php

namespace Avem;

use Illuminate\Database\Eloquent\Model;

class PerformedActivity extends Model
{
	public function activity()
	{
		return $this->belongsTo('Avem\Activity');
	}

	public function witnesserPeriod()
	{
		return $this->belongsTo('Avem\MbMemberPeriod');
	}

	public function user()
	{
		return $this->belongsTo('Avem\User');
	}
}
