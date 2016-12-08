<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityTask extends Model implements Notifiable
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'description', 'location', 'start', 'end',
		'inscription_start', 'inscription_end', 'member_limit',
		'is_mandatory', 'inscription_policy', 'points',
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

	public function getNotifiableReceiversAttribute()
	{
		return $this->inscribedUsers;
	}

	public function inscribedUsers()
	{
		return $this->belongsToMany('App\User', 'activity_task_all_users');
	}

	public function notifications()
	{
		return $this->morphMany('App\Notification', 'notifiable');
	}

	public function selfInscribedUsers()
	{
		return $this->belongsToMany('App\User');
	}

	public function transactions()
	{
		return $this->morphMany('App\Transaction', 'transactionable');
	}
}
