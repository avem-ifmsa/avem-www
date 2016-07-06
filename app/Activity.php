<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'public', 'location',
        'start', 'end', 'subscription_start',
        'subscription_end',
    ];

    /**
     * Additional fields to treat as Carbon instances.
     *
     * @var array
     */
    protected $dates = [
        'start', 'end', 'subscription_start', 'subscription_end'
    ];

    public function setStartAttribute($datetime)
    {
        $this->attributes['start'] = $datetime ?: Carbon::parse($datetime);
    }

    public function setEndAttribute($datetime)
    {
        $this->attributes['end'] = $datetime ?: Carbon::parse($datetime);
    }

    public function setSubscriptionStartAttribute($datetime)
    {
        $this->attributes['subscription_start'] = $datetime ?: Carbon::parse($datetime);
    }

    public function setSubscriptionEndAttribute($datetime)
    {
        $this->attributes['subscription_end'] = $datetime ?: Carbon::parse($datetime);
    }

    public function tasks()
    {
        return $this->hasMany('App\ActivityTask');
    }

    public function organizers()
    {
        return $this->belongsToMany('App\MbMember')->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany('App\ActivityTag')->withTimestamps();
    }

    public function subscribers()
    {
        return $this->belongsToMany('App\Member', 'activity_subscribers')
                    ->withTimestamps();
    }

    public function assistants()
    {
        return $this->tasks->pluck('registeredMembers')->flatten()->unique('id');
    }

    public function scopePublic($query)
    {
        $query->where('public', true);
    }

    private function subscriptionPeriodHasStarted($now)
    {
        if (is_null($this->subscription_start)) return true;
        return $this->subscription_start <= $now;
    }

    private function subscriptionPeriodIsOver($now)
    {
        if (is_null($this->subscription_end)) return false;
        return $this->subscription_end < $now;
    }

    public function getIsAvailableAttribute()
    {
        $now = Carbon::now();
        if ($this->end < $now) return false;
        if (!$this->subscriptionPeriodHasStarted($now)) return false;
        if ($this->subscriptionPeriodIsOver($now)) return false;
        return ! $this->tasks()->filter(function($task) {
            return $task->is_available;
        })->isEmpty();
    }

}
