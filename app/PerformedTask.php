<?php

namespace Avem;

use Illuminate\Database\Eloquent\Model;

class PerformedTask extends Model implements Transactionable
{
	public function activityTask()
	{
		return $this->belongsTo('Avem\ActivityTask');
	}

	public function applierPeriod()
	{
		return $this->belongsTo('Avem\MbMemberPeriod');
	}

	public function getTransactionConceptAttribute()
	{
		$taskName = $this->activityTask->name;
		return "Realización tarea '$taskName'";
	}

	public function getTransactionPointsAttribute()
	{
		return $this->points;
	}

	public function user()
	{
		return $this->belongsTo('Avem\User');
	}
}
