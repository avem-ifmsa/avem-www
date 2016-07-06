<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityTag extends Model
{

    protected $fillable = [
        'name'
    ];

    public function activities()
    {
        return $this->belongsToMany('App\Activity')->withTimestamps();
    }

    public function subscribedMembers()
    {
        return $this->belongsToMany('App\Member')->withTimestamps();
    }

}
