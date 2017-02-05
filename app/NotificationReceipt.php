<?php

namespace Avem;

use Illuminate\Database\Eloquent\Model;

class NotificationReceipt extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'read_at',
	];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'created_at', 'updated_at', 'read_at',
	];

	public function getIsReadAttribute()
	{
		return $this->read_at !== null;
	}

	public function notification()
	{
		return $this->belongsTo('Avem\Notification');
	}

	public function scopeUnread($query)
	{
		return $query->whereNull('read_at');
	}

	public function user()
	{
		return $this->belongsTo('Avem\User');
	}
}
