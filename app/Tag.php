<?php

namespace Avem;

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
		return $this->morphedByMany('Avem\Activity', 'taggable');
	}

	public function subscribedUsers()
	{
		return $this->morphMany('Avem\User', 'subscribable');
	}

	public function workingGroups()
	{
		return $this->morphedByMany('Avem\WorkingGroup', 'taggable');
	}
}
