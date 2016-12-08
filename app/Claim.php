<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model implements Notifiable
{
	public function activityTask()
	{
		return $this->belongsTo('App\ActivityTask');
	}

	public function getNotifiableReceiversAttribute()
	{
		return [$this->user];
	}

	public function notifications()
	{
		return $this->morphMany('App\Notification', 'notifiable');
	}

	public function resolution()
	{
		return $this->hasOne('App\Resolution');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
