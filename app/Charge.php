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
		'name', 'description', 'email', 'order',
	];

	public static function boot()
	{
		parent::boot();
	}

	public function chargeRoles()
	{
		return $this->belongsToMany('Avem\Role');
	}

	public function mbMemberPeriods()
	{
		return $this->hasMany('Avem\MbMemberPeriod');
	}

	public function workingGroup()
	{
		return $this->belongsTo('Avem\WorkingGroup');
	}
}
