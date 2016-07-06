<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{

    use EntrustUserTrait;

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
