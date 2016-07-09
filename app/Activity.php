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
        'name', 'description', 'is_public', 'location',
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

    public function setStartAttribute($dt)
    {
        $this->attributes['start'] = $dt ? Carbon::parse($dt) : null;
    }

    public function setEndAttribute($dt)
    {
        $this->attributes['end'] = $dt ? Carbon::parse($dt) : null;
    }

    public function setSubscriptionStartAttribute($dt)
    {
        $this->attributes['subscription_start'] = $dt ? Carbon::parse($dt) : null;
    }

    public function setSubscriptionEndAttribute($dt)
    {
        $this->attributes['subscription_end'] = $dt ? Carbon::parse($dt) : null;
    }

    public function tasks()
    {
        return $this->hasMany('App\ActivityTask');
    }

    public function organizers()
    {
        return $this->belongsToMany('App\MbMember')->withTimestamps();
    }

    public function getOrganizerListAttribute()
    {
        return $this->organizers()->pluck('id')->toArray();
    }

    public function tags()
    {
        return $this->belongsToMany('App\ActivityTag')->withTimestamps();
    }

    public function getTagListAttribute()
    {
        return $this->tags()->pluck('id')->toArray();
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
        $query->where('is_public', true);
    }

    private function activityIsOver($now)
    {
        if (is_null($this->end)) return false;
        return $this->end < $now;
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

    private function availableTasks()
    {
        return $this->tasks->where('is_available', true);
    }

    public function getIsAvailableAttribute()
    {
        $now = Carbon::now();
        if ($this->activityIsOver($now)) return false;
        if (!$this->subscriptionPeriodHasStarted($now)) return false;
        if ($this->subscriptionPeriodIsOver($now)) return false;
        return !$this->availableTasks()->isEmpty();
    }

}
