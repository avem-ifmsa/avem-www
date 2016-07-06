<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'message'
    ];

    public function tickets()
    {
        return $this->hasMany('App\NotificationTicket');
    }

}
