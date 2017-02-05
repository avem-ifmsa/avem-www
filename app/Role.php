<?php

namespace Avem;

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
		return $this->belongsToMany('Avem\Charge');
	}

	public function permissions()
	{
		return $this->belongsToMany('Avem\Permission');
	}

	public function users()
	{
		return $this->belongsToMany('Avem\User');
	}
}
