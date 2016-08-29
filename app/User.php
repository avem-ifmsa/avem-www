<?php

namespace App;

use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Krucas\LaravelUserEmailVerification\RequiresEmailVerification;
use Krucas\LaravelUserEmailVerification\Contracts\RequiresEmailVerification as RequiresEmailVerificationContract;

class User extends Authenticatable implements RequiresEmailVerificationContract
{

    use EntrustUserTrait, RequiresEmailVerification;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function getRoleListAttribute()
    {
        return $this->roles()->pluck('id')->toArray();
    }

    public function member()
    {
        return $this->hasOne('App\Member');
    }

    public function subscribedActivities()
    {
        return $this->belongsToMany('App\Activity', 'activity_subscribers')
                    ->withTimestamps();
    }

    public function assistedActivities()
    {
        return $this->belongsToMany('App\Activity', 'activity_assistants')
                    ->withTimestamps();
    }

}
