<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
	];

	public function activities()
	{
		return $this->morphedByMany('App\Activity', 'taggable');
	}

	public function subscribedUsers()
	{
		return $this->morphMany('App\User', 'subscribable');
	}

	public function workingGroups()
	{
		return $this->morphedByMany('App\WorkingGroup', 'taggable');
	}
}
