<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email',
	];

	public function roles()
	{
		return $this->belongsToMany('App\Role');
	}
	
	public function workingGroup()
	{
		return $this->belongsTo('App\WorkingGroup');
	}
}
