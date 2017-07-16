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

	public function getInternalNameAttribute()
	{
		return $this->ifmsa_acronym ?? $this->ifmsa_name ?? $this->name;
	}

	public function ownTags()
	{
		return $this->morphToMany('Avem\Tag', 'taggable');
	}

	public function periods()
	{
		return $this->hasMany('Avem\ChargePeriod');
	}

	public function roles()
	{
		return $this->belongsToMany('Avem\Role');
	}

	public function tags()
	{
		$ownTags = $this->ownTags();

		$groupTags = Charge::find($this->id)
			->select('tags.*', 'charges.id as pivot_charge_id', 'tags.id as pivot_tag_id')
			->join('working_groups', 'working_groups.id', '=', 'charges.working_group_id')
			->join('taggables', function($join) {
				$join->on('taggable_id', '=', 'working_groups.id');
				$join->on('taggable_type', '=', 'working_group');
			})->join('tags', 'tags.id', '=', 'taggables.tag_id');
		
		return $ownTags->union($groupTags);
	}

	public function workingGroup()
	{
		return $this->belongsTo('Avem\WorkingGroup');
	}
}
