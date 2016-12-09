<?php

namespace App;

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
		return $this->belongsTo('App\Activity');
	}

	public function performedTaskRecords()
	{
		return $this->hasMany('App\PerformedTaskRecord');
	}

	public function transactions()
	{
		return $this->morphMany('App\Transaction', 'transactionable');
	}
}
