<?php

namespace Avem;

use Illuminate\Database\Eloquent\Model;

class WorkingGroup extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'description',
	];

	public function charges()
	{
		return $this->hasMany('Avem\Charge');
	}

	public function mbMembers()
	{
		return $this->belongsToMany('Avem\MbMember');
	}

	public function tags()
	{
		return $this->morphToMany('Avem\Tag', 'taggable');
	}
}
