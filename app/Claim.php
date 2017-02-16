<?php

namespace Avem;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model implements Notifiable
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'info',
	];

	public function activityTask()
	{
		return $this->belongsTo('Avem\ActivityTask');
	}

	public function getNotifiableReceiversAttribute()
	{
		return [$this->user];
	}

	public function notifications()
	{
		return $this->morphMany('Avem\Notification', 'notifiable');
	}

	public function resolution()
	{
		return $this->hasOne('Avem\ClaimResolution');
	}

	public function user()
	{
		return $this->belongsTo('Avem\User');
	}
}
