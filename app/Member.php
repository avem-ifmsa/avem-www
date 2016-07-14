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
        $this->attributes['birthday'] = $date ? Carbon::parse($date) : null;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function mbMember()
    {
        return $this->hasOne('App\MbMember', 'id');
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

    public function scopeActive($query)
    {
        $now = Carbon::now();
        $query->join('member_renewals', 'members.id', '=', 'member_id')
              ->where('member_renewals.until', '>=', $now)
              ->select('members.*');
    }

    public function scopeInactive($query)
    {
        $now = Carbon::now();
        $query->leftJoin('member_renewals', 'members.id', '=', 'member_id')
              ->orderBy('member_renewals.until', 'desc')->take(1)
              ->where('member_renewals.until', '<', $now)
              ->orWhere('member_renewals.until', null)
              ->select('members.*');
    }

    public function getActiveUntilAttribute()
    {
        $latestRenewal = $this->renewals()->latest('until')->first();
        return $latestRenewal ? $latestRenewal->until : null;
    }

    public function getIsActiveAttribute()
    {
        $activeUntil = $this->active_until;
        if (is_null($activeUntil)) return false;
        return $activeUntil > Carbon::now();
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
