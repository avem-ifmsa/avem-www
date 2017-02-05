<?php

namespace Avem;

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

	public function chargeRoles()
	{
		return $this->belongsToMany('Avem\Role');
	}

	public function workingGroup()
	{
		return $this->belongsTo('Avem\WorkingGroup');
	}
}
