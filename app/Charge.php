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
		'name', 'ifmsa_name', 'ifmsa_acronym', 'description', 'email', 'index',
	];

	public function chargeRoles()
	{
		return $this->belongsToMany('Avem\Role');
	}

	public function chargePeriods()
	{
		return $this->hasMany('Avem\ChargePeriod');
	}

	public function workingGroup()
	{
		return $this->belongsTo('Avem\WorkingGroup');
	}
}
