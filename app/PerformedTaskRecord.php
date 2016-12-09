<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerformedTaskRecord extends Model
{
	public function activityTask()
	{
		return $this->belongsTo('App\ActivityTask');
	}

	public function applierPeriod()
	{
		return $this->belongsTo('App\MbMemberPeriod');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
