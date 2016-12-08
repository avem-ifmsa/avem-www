<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
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
		return $this->belongsToMany('App\Charge');
	}

	public function mbMembers()
	{
		return $this->belongsToMany('App\MbMember');
	}

	public function permissions()
	{
		return $this->belongsToMany('App\Permission');
	}

	public function users()
	{
		return $this->belongsToMany('App\User');
	}
}
