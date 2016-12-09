<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model implements Notifiable
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'image', 'description', 'visibility',
	];

	public function getNotifiableReceiversAttribute()
	{
		return $this->subscribedUsers;
	}

	public function inscribedUsers()
	{
		return $this->belongsToMany('App\User');
	}

	public function notifications()
	{
		return $this->morphMany('App\Notification', 'notifiable');
	}

	public function organizerPeriods()
	{
		return $this->belongsToMany('App\MbMemberPeriod');
	}

	public function selfSubscribedUsers()
	{
		return $this->morphToMany('App\User', 'subscribable');
	}

	public function subscribedUsers()
	{
		return $this->morphToMany('App\User', 'subscribable', 'subscribables_all');
	}

	public function tags()
	{
		return $this->morphToMany('App\Tag', 'taggable');
	}

	public function tasks()
	{
		return $this->hasMany('App\ActivityTask');
	}
}
