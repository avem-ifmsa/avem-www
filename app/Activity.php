<?php

namespace Avem;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model implements Notifiable
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'image_url', 'description', 'visibility', 'location',
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
		return $this->belongsToMany('Avem\User');
	}

	public function notifications()
	{
		return $this->morphMany('Avem\Notification', 'notifiable');
	}

	public function organizerPeriods()
	{
		return $this->belongsToMany('Avem\MbMemberPeriod');
	}

	public function selfInscribedUsers()
	{
		return $this->belongsToMany('Avem\User', 'self_inscribed_activity_users');
	}

	public function selfSubscribedUsers()
	{
		return $this->morphToMany('Avem\User', 'subscribable');
	}

	public function subscribedUsers()
	{
		return $this->morphToMany('Avem\User', 'subscribable', 'all_subscribables');
	}

	public function tags()
	{
		return $this->morphToMany('Avem\Tag', 'taggable');
	}

	public function tasks()
	{
		return $this->hasMany('Avem\ActivityTask');
	}
}
