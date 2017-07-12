<?php

namespace Avem;

use Storage;
use Laravel\Scout\Searchable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class User extends Authenticatable implements HasMediaConversions
{
	use Notifiable;
	use Searchable;
	use HasApiTokens;
	use HasMediaTrait;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'surname', 'gender', 'birthday', 'email', 'password',
	];
	
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'created_at', 'updated_at', 'birthday',
	];

	public function chargePeriods()
	{
		return $this->hasMany('Avem\ChargePeriod');
	}

	public function filedClaims()
	{
		return $this->hasMany('Avem\Claim');
	}

	public function getCurrentChargePeriodAttribute()
	{
		return $this->chargePeriods()->active()->orderBy('start', 'desc')->first();
	}

	public function getCurrentChargeAttribute()
	{
		$currentPeriod = $this->currentChargePeriod;
		return $currentPeriod ? $currentPeriod->charge : null;
	}

	public function getFullNameAttribute()
	{
		$name = $this->attributes['name'];
		$surname = $this->attributes['surname'];
		return "$name $surname";
	}

	public function getHasActiveChargeAttribute()
	{
		return $this->chargePeriods()->active()->exists();
	}

	public function getIsActiveAttribute()
	{
		return $this->renewals()->active()->exists();
	}

	public function getPointsAttribute()
	{
		$transactions = $this->transactions()->oldest()->get();
		return $transactions->reduce(function($result, $t) {
			return max($result + $t->points, 0);
		}, 0);
	}

	public function getProfileImageAttribute()
	{
		return $this->getMedia('avatars')->first();
	}

	public function hasPermission($name)
	{
		$this->load('roles.permissions');
		foreach ($this->roles as $role) {
			if ($role->permissions->contains('name', $name))
				return true;
		}
		return false;
	}

	public function inscribedActivities()
	{
		return $this->belongsToMany('Avem\Activity');
	}

	public function issuedRenewals()
	{
		return $this->hasManyThrough('Avem\Renewal', 'Avem\ChargePeriod');
	}

	public function notificationReceipts()
	{
		return $this->hasMany('Avem\NotificationReceipt');
	}

	public function ownRoles()
	{
		return $this->belongsToMany('Avem\Role', 'own_user_roles');
	}

	public function performedActivities()
	{
		return $this->hasMany('Avem\PerformedActivity');
	}

	public function publishedExchanges()
	{
		return $this->hasManyThrough('Avem\Exchange', 'Avem\ChargePeriod');
	}

	public function registerMediaConversions()
	{
		$this->addMediaConversion('thumb')
		     ->width(368)->height(232)
		     ->sharpen(10);
	}

	public function setNameAttribute($firstName)
	{
		$firstName = trim($firstName);
		$firstName = preg_replace('/\s+/', ' ', $firstName);
		$firstName = ucwords(strtolower($firstName));

		$this->attributes['name'] = $firstName;
	}

	public function setSurnameAttribute($lastName)
	{
		$lastName = trim($lastName);
		$lastNameWords = preg_split('/\s+/', $lastName);
		$lastNameWords = array_map(function($w) {
			$w = strtolower($w);
			if (in_array($w, ['de', 'la', 'del']))
				return $w;
			return ucfirst($w);
		}, $lastNameWords);

		$this->attributes['surname'] = implode(' ', $lastNameWords);
	}

	public function setGenderAttribute($gender)
	{
		if ($gender !== null)
			$gender = strtolower($gender);
		$this->attributes['gender'] = $gender;
	}

	public function subscribedActivities()
	{
		return $this->morphedByMany('Avem\Activity', 'subscribable');
	}

	public function renewals()
	{
		return $this->hasMany('Avem\Renewal');
	}

	public function resolvedClaims()
	{
		return $this->hasManyThrough('Avem\ClaimResolution', 'Avem\ChargePeriod');
	}

	public function roles()
	{
		return $this->belongsToMany('Avem\Role');
	}

	public function scopeWithActiveCharge($query)
	{
		return $query->join('charge_periods', 'charge_periods.user_id', '=', 'users.id')
		             ->where('start', '<=', 'CURRENT_TIMESTAMP')->where('end', '>', 'CURRENT_TIMESTAMP')
		             ->select('users.*');
	}

	public function selfInscribedActivities()
	{
		return $this->belongsToMany('Avem\Activity', 'self_inscribed_activity_users');
	}

	public function selfSubscribedActivities()
	{
		return $this->morphedByMany('Avem\Activity', 'subscribable', 'own_subscribables');
	}

	public function transactions()
	{
		return $this->hasMany('Avem\Transaction');
	}

	public function witnessedActivities()
	{
		return $this->hasManyThrough('Avem\PerformedActivity', 'Avem\ChargePeriod');
	}
}
