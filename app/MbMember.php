<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MbMember extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'dni_nif', 'phone',
	];

	public function mbMemberPeriods()
	{
		return $this->hasMany('App\MbMemberPeriod');
	}

	public function getHasActiveChargeAttribute()
	{
		return $this->mbMemberPeriods()->active()->exists();
	}

	public function roles()
	{
		return $this->belongsToMany('App\Role');
	}

	public function user()
	{
		return $this->belongsTo('App\User', 'id');
	}
}
