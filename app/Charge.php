<?php

namespace Avem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Charge extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'ifmsa_name', 'ifmsa_acronym', 'description', 'email', 'index',
	];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'created_at', 'updated_at', 'deleted_at',
	];

	public function chargeRoles()
	{
		return $this->belongsToMany('Avem\Role');
	}

	public function periods()
	{
		return $this->hasMany('Avem\ChargePeriod');
	}

	public function getInternalNameAttribute()
	{
		return $this->ifmsa_acronym ?? $this->ifmsa_name ?? $this->name;
	}

	public function workingGroup()
	{
		return $this->belongsTo('Avem\WorkingGroup');
	}
}
