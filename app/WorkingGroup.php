<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingGroup extends Model implements Notifiable
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

	public function getNotifiableReceiversAttribute()
	{
		return User::hydrate($this->charges()
			->join('mb_member_periods', 'mb_member_periods.charge_id', '=', 'charges.id')
			->join('users', 'users.id', '=', 'mb_member_periods.mb_member_id')
			->select('users.*')->get()->toArray()
		);
	}

	public function tags()
	{
		return $this->morphToMany('App\Tag');
	}
}
