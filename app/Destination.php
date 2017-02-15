<?php

namespace Avem;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'image_url', 'name', 'type',
	];

	public function exchanges()
	{
		return $this->hasMany('Avem\Exchange');
	}

}
