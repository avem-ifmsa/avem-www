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
		'name', 'image', 'description', 'visibility', 'location',
		'start', 'end', 'subscription_start', 'subscription_end',
		'member_limit', 'inscription_policy',
	];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'created_at', 'updated_at', 'start', 'end',
		'inscription_start', 'inscription_end',
	];

	public function getNotifiableReceiversAttribute()
	{
		return $this->subscribedUsers;
	}

	public function inscribedUsers()
	{
		return $this->belongsToMany('App\User', 'activity_user_all');
	}

	public function notifications()
	{
		return $this->morphMany('App\Notification', 'notifiable');
	}

	public function organizerPeriods()
	{
		return $this->belongsToMany('App\MbMemberPeriod');
	}

	public function selfInscribedUsers()
	{
		return $this->belongsToMany('App\User');
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
