<?php

namespace App;

use App\Notifiable as AppNotifiable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements AppNotifiable
{
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'surname', 'email',
	];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'created_at', 'updated_at',
	];

	public function directNotifications()
	{
		return $this->morphMany('App\Notification', 'notifiable');
	}

	public function filedClaims()
	{
		return $this->hasMany('App\Claim');
	}

	public function getIsActiveAttribute()
	{
		return $this->renewals()->active()->exists();
	}

	public function getNotifiableReceiversAttribute()
	{
		return [$this];
	}

	public function hasPermission($name)
	{
		$this->load('ownRoles.permissions');
		foreach ($this->ownRoles as $role) {
			if ($role->permissions->contains('name', $name))
				return true;
		}
		if ($mbMember = $this->mbMember) {
			$mbMember->load('roles.permissions');
			foreach ($mbMember->roles as $role) {
				if ($role->permissions->contains('name', $name))
					return true;
			}
		}
		return false;
	}

	public function inscribedActivityTasks()
	{
		return $this->belongsToMany('App\ActivityTask', 'activity_task_all_users');
	}

	public function mbMember()
	{
		return $this->hasOne('App\MbMember', 'id');
	}

	public function notificationReceipts()
	{
		return $this->hasMany('App\NotificationReceipt');
	}

	public function ownRoles()
	{
		return $this->belongsToMany('App\Role');
	}

	public function renewals()
	{
		return $this->hasMany('App\Renewal');
	}

	public function selfInscribedActivityTasks()
	{
		return $this->belongsToMany('App\ActivityTask');
	}

	public function subscribables()
	{
		return $this->morphedByMany('subscribables');
	}

	public function transactions()
	{
		return $this->hasMany('App\Transaction');
	}
}
