<?php

namespace Avem;

use Illuminate\Database\Eloquent\Model;

class MbMember extends Model
{
	/**
	 * Primary key is not autoincrement.
	 *
	 * @var bool
	 */
	public $incrementing = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'dni_nif', 'phone',
	];

	public function getHasActiveChargeAttribute()
	{
		return $this->mbMemberPeriods()->active()->exists();
	}

	public function issuedRenewals()
	{
		return $this->hasManyThrough('Avem\Renewal', 'Avem\MbMemberPeriod');
	}

	public function mbMemberPeriods()
	{
		return $this->hasMany('Avem\MbMemberPeriod');
	}

	public function publishedExchanges()
	{
		return $this->hasManyThrough('Avem\Exchange', 'Avem\MbMemberPeriod');
	}

	public function resolvedClaims()
	{
		return $this->hasManyThrough('Avem\ClaimResolution', 'Avem\MbMemberPeriod');
	}

	public function scopeActive($query)
	{
		$now = Carbon::now();
		return $query->join('mb_member_periods', 'mb_member_periods.id', '=', 'mb_members.id')
		             ->where('start', '<=', $now)->where('end', '>', $now)
		             ->select('mb_members.*');
	}

	public function user()
	{
		return $this->belongsTo('Avem\User', 'id');
	}

	public function witnessedActivities()
	{
		return $this->hasManyThrough('Avem\PerformedActivity', 'Avem\MbMemberPeriod');
	}
}
