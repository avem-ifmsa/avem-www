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
		'concept', 'points'
	];

	public function transactionConcept()
	{
		return $this->concept;
	}

	public function transactionPoints()
	{
		return $this->points;
	}
}
