<?php

namespace Avem;

use Illuminate\Database\Eloquent\Model;
use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Exchange extends Model
{
	use HasMediaTrait;
	use AlgoliaEloquentTrait;

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

	/**
	 * Algolia search settings for this model.
	 *
	 * @var array
	 */
	public $algoliaSettings = [
		'searchableAttributes' => [
			'destination', 'type', 'modality',
		],
		'customRanking' => [
			'desc(created_at)', 'desc(id)',
		],
	];

	public function destination()
	{
		return $this->belongsTo('Avem\Destination');
	}

	public function indexOnly($indexName)
	{
		return $this->published;
	}

	public function publishedPeriod()
	{
		return $this->belongsTo('Avem\MbMemberPeriod');
	}
}
