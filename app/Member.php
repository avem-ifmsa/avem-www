<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'gender', 'birthday'
    ];

    /**
     * Additional fields to treat as Carbon instances.
     *
     * @var array
     */
    protected $dates = [
        'birthday'
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function setBirthdayAttribute($date)
    {
        $this->attributes['birthday'] = $date ?: Carbon::parse($date);
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function mbMember()
    {
        return $this->hasOne('App\MbMember');
    }

    public function pointsTransactions()
    {
        return $this->hasMany('App\PointsTransaction');
    }

    public function getPointsAttribute()
    {
        return $this->pointsTransactions
                    ->sortBy('applied_at')->pluck('points')
                    ->reduce(function($result, $points) {
                        return max($result + $points, 0);
                    }, 0);
    }

    public function renewals()
    {
        return $this->hasMany('App\MemberRenewal');
    }

    public function getIsActiveAttribute()
    {
        $latestRenewal = $this->renewals()->latest('until')->first();
        return !is_null($latestRenewal) && Carbon::now() < $latestRenewal->until;
    }

    public function registeredActivities()
    {
        return $this->registeredTasks->pluck('activity')->unique('id');
    }

    public function registeredTasks()
    {
        return $this->belongsToMany('App\ActivityTask')->withTimestamps();
    }

    public function subscribedActivities()
    {
        return $this->belongsToMany('App\Activity', 'activity_subscribers')
                    ->withTimestamps();
    }

    public function subscribedTags()
    {
        return $this->belongsToMany('App\ActivityTag')->withTimestamps();
    }

    public function notificationTickets()
    {
        return $this->hasMany('App\NotificationTicket');
    }

}
