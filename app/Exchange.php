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
		'conditions', 'reports', 'lc_nmo', 'vacancies',
		'observations', 'requirements', 'published',
		'modality', 
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'published'  => 'boolean',
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
