<?php

namespace Avem;

use Illuminate\Database\Eloquent\Model;

class PerformedTaskRecord extends Model
{
	public function activityTask()
	{
		return $this->belongsTo('Avem\ActivityTask');
	}

	public function applierPeriod()
	{
		return $this->belongsTo('Avem\MbMemberPeriod');
	}

	public function user()
	{
		return $this->belongsTo('Avem\User');
	}
}
