<?php

namespace Avem;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title', 'message',
	];

	public function notifiable()
	{
		return $this->morphTo();
	}

	public function receipts()
	{
		return $this->hasMany('Avem\NotificationReceipt');
	}

	public function senderPeriod()
	{
		return $this->belongsTo('Avem\MbMemberPeriod');
	}
}
