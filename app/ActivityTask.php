<?php

namespace Avem;

use Illuminate\Database\Eloquent\Model;

class ActivityTask extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'description', 'is_mandatory', 'points',
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'is_mandatory'  => 'boolean',
	];

	public function activity()
	{
		return $this->belongsTo('Avem\Activity');
	}

	public function performedTaskRecords()
	{
		return $this->hasMany('Avem\PerformedTask');
	}

	public function subscribedUsers()
	{
		return $this->morphToMany('Avem\User', 'subscribable', 'all_subscribables');
	}

	public function transactions()
	{
		return $this->morphMany('Avem\Transaction', 'transactionable');
	}
}
