<?php

namespace Avem;

use Auth;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Exchange extends Model
{
	use Searchable;
	use HasMediaTrait;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'destination', 'conditions', 'type', 'reports', 'vacancies',
		'observations', 'requirements', 'published', 'modality',
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'published' => 'boolean',
	];

	public static function saving(Exchange $exchange)
	{
		parent::saving($exchange);

		$chargePeriod = Auth::user()->currentChargePeriod;
		$exchange->publisherPeriod()->associate($chargePeriod);
	}

	public function publisherPeriod()
	{
		return $this->belongsTo('Avem\ChargePeriod', 'charge_period_id');
	}
}
