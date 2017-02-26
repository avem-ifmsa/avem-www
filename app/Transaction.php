<?php

namespace Avem;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	public function transactionable()
	{
		return $this->morphTo();
	}

	public function getApplierPeriodAttribute()
	{
		return $this->transactionable->transactionPeriod;
	}

	public function getConceptAttribute()
	{
		return $this->transactionable->transactionConcept;
	}

	public function getPointsAttribute()
	{
		return $this->transactionable->transactionPoints;
	}
}
