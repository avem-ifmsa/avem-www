<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class MbMember extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dni_nif', 'phone'
    ];

    public function member()
    {
        return $this->belongsTo('App\Member', 'id');
    }

    public function periods()
    {
        return $this->hasMany('App\MbMemberPeriod');
    }

    public function getIsActiveAttribute()
    {
        return $this->periods()->active()->count() > 0;
    }

    public function organizedActivities()
    {
        return $this->belongsToMany('App\Activity')->withTimestamps();
    }

    public function appliedTransactions()
    {
        return $this->hasMany('App\PointsTransaction');
    }

    public function appliedRenewals()
    {
        return $this->hasMany('App\MemberRenewal');
    }

}
