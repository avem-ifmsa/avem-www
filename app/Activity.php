<?php

namespace Avem;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'description', 'location', 'start', 'end', 'visibility',
		'inscription_policy', 'inscription_start', 'inscription_end',
		'member_limit', 'points', 'image',
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

	public function performedActivityRecords()
	{
		return $this->hasMany('Avem\PerformedActivity');
	}

	public function selfInscribedUsers()
	{
		return $this->belongsToMany('Avem\User', 'self_inscribed_activity_users');
	}

	public function selfSubscribedUsers()
	{
		return $this->morphToMany('Avem\User', 'subscribable');
	}

	public function setEndAttribute($date) {
		$this->attributes['end'] = Carbon::parse($date);
	}

	public function setInscriptionEndAttribute($date) {
		$this->attributes['inscription_end'] = Carbon::parse($date);
	}

	public function setInscriptionStartAttribute($date) {
		$this->attributes['inscription_start'] = Carbon::parse($date);
	}

	public function setStartAttribute($date) {
		$this->attributes['start'] = Carbon::parse($date);
	}

	public function subscribedUsers()
	{
		return $this->morphToMany('Avem\User', 'subscribable', 'all_subscribables');
	}

	public function tags()
	{
		return $this->morphToMany('Avem\Tag', 'taggable');
	}

	public function transactions()
	{
		return $this->morphMany('Avem\Transaction', 'transactionable');
	}
}
