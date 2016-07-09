<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class NotificationTicket extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'read_at'
    ];

    /**
     * Additional fields to treat as Carbon instances.
     *
     * @var array
     */
    protected $dates = [
        'read_at'
    ];

    public function getIsReadAttribute()
    {
        return !is_null($this->read_at);
    }

    public function member()
    {
        return $this->belongsTo('App\Member');
    }

    public function notification()
    {
        return $this->belongsTo('App\Notification');
    }

}
