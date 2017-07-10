<?php

namespace Avem;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Activity extends Model implements HasMediaConversions
{
	use HasMediaTrait;
	use AlgoliaEloquentTrait;

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

	/**
	 * Algolia search settings for this model.
	 *
	 * @var array
	 */
	public $algoliaSettings = [
		'searchableAttributes' => [
			'name', 'description', 'location',
		],
		'customRanking' => [
			'desc(created_at)', 'desc(id)',
		],
	];

	public function getNotifiableReceiversAttribute()
	{
		return $this->subscribedUsers;
	}

	public function indexOnly($indexName)
	{
		return $this->published;
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

	public function registerMediaConversions()
	{
		$this->addMediaConversion('thumb')
		     ->width(368)->height(232)
		     ->sharpen(10);
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
