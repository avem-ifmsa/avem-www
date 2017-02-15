<?php

namespace Avem;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'conditions', 'is_active', 'modality', 'observations', 'requirements',
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'is_active'  => 'boolean',
	];

	public function destination()
	{
		return $this->belongsTo('Avem\Destination');
	}

	public function publishedPeriod()
	{
		return $this->belongsTo('Avem\MbMemberPeriod');
	}

}
