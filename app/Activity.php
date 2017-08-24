<?php

namespace Avem;

use DB;
use Avem\User;
use Carbon\Carbon;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Activity extends Model implements HasMediaConversions
{
	use Searchable;
	use HasMediaTrait;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'description', 'location', 'start', 'end', 'audience',
		'inscription_policy', 'inscription_start', 'inscription_end',
		'member_limit', 'points', 'image', 'published',
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

	public function activityTickets()
	{
		return $this->hasMany('Avem\ActivityTicket');
	}

	public function ticketLots()
	{
		return $this->activityTickets()
		            ->select('charge_period_id', 'activity_id', 'created_at', 'expires_at')
		            ->groupBy('charge_period_id', 'activity_id', 'created_at', 'expires_at');
	}

	public function getImageAttribute()
	{
		return $this->getMedia('images')->first();
	}

	public function getImageUrlAttribute()
	{
		$image = $this->image;
		if (!$image)
			return asset('img/activity-default-image.svg');
		return $image->getUrl();
	}

	public function getIsReadyToPublishAttribute()
	{
		return $this->name !== null
		    && $this->description !== null
		    && $this->image !== null;
	}

	public function inscribedUsers()
	{
		switch ($this->inscription_policy) {
			case 'inscribed':
				return $this->selfInscribedUsers;

			case 'board':
				return User::hydrate($this->query()->crossJoin('charge_periods')
					->join('users', 'users.id', '=', 'charge_periods.user_id')
					->select('users.*', 'activities.id as pivot_activity_id', 'users.id as pivot_user_id')
					->where('activities.id', $this->id)
					->whereRaw('activities.start BETWEEN charge_periods.start AND charge_periods.end')
					->orWhereRaw('activities.end BETWEEN charge_periods.start AND charge_periods.end')
					->get()->toArray());

			case 'all':
				return User::hydrate($this->query()->crossJoin('users')
					->select('users.*', 'activities.id as pivot_activity_id', 'users.id as pivot_user_id')
					->whereRaw('users.created_at < activities.end')->orWhere('activities.end', null)
					->where('activities.id', $this->id)
					->get()->toArray());
		}
	}

	public function notifications()
	{
		return $this->morphMany('Avem\Notification', 'notifiable');
	}

	public function organizerPeriods()
	{
		return $this->belongsToMany('Avem\ChargePeriod');
	}

	public function performedActivityRecords()
	{
		return $this->hasMany('Avem\PerformedActivity');
	}

	public function registerMediaConversions()
	{
		$this->addMediaConversion('thumb')
		     ->width(368)->height(232)
		     ->sharpen(10);
	}

	public function scopeInscribableBy($query, User $user)
	{
		$query->where('published', true);

		$now = Carbon::now();
		$query->where(function($q) use ($now) {
			$q->whereDate('inscription_start', '>=', $now)
			  ->orWhere('inscription_start', null);
		});
		$query->where(function($q) use ($now) {
			$q->whereDate('inscription_end', '<', $now)
			  ->orWhere('inscription_end', null);
		});

		$userAudiences = ['all'];
		if ($user->hasActiveCharge)
			array_push($userAudiences, 'board');
		$query->whereIn('audience', $userAudiences);
	}

	public function scopeUpcoming($query)
	{
		$query->where(function($q) {
			$q->whereDate('end', '>', Carbon::now())->orWhere('end', null);
		});
	}

	public function setStartAttribute($date)
	{
		$this->attributes['start'] = $date
			? Carbon::createFromFormat('Y-m-d\TH:i', $date)
			: null;
	}

	public function setEndAttribute($date)
	{
		$this->attributes['end'] = $date
			? Carbon::createFromFormat('Y-m-d\TH:i', $date)
			: null;
	}

	public function setInscriptionStartAttribute($date)
	{
		$this->attributes['inscription_start'] = $date
			? Carbon::createFromFormat('Y-m-d', $date)
			: null;
	}

	public function setInscriptionEndAttribute($date)
	{
		$this->attributes['inscription_end'] = $date
			? Carbon::createFromFormat('Y-m-d', $date)
			: null;
	}

	public function selfInscribedUsers()
	{
		return $this->belongsToMany('Avem\User');
	}

	public function tags()
	{
		return $this->morphToMany('Avem\Tag', 'taggable');
	}

	public function toSearchableArray()
	{
		$data = $this->toArray();
		$data['tags'] = $this->tags->pluck('name');
		return $data;
	}

	public function transactions()
	{
		return $this->morphMany('Avem\Transaction', 'transactionable');
	}
}
