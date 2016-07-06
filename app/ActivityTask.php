<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ActivityTask extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'points', 'member_limit'
    ];

    public function activity()
    {
        return $this->belongsTo('App\Activity');
    }

    public function registeredMembers()
    {
        return $this->belongsToMany('App\Member');
    }

    public function transactions()
    {
        return $this->hasMany('App\ActivityTaskTransaction');
    }

    public function getIsAvailableAttribute()
    {
        if (is_null($this->member_limit)) return true;
        return $this->registeredMembers()->count() < $this->member_limit;
    }

}
