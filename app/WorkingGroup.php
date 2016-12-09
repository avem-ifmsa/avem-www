<?php

namespace App;

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
		return $this->hasMany('App\Charge');
	}

	public function mbMembers()
	{
		return $this->belongsToMany('App\MbMember');
	}

	public function tags()
	{
		return $this->morphToMany('App\Tag');
	}
}
