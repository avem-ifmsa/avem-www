<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityTaskTransaction extends Model
{

    public function transaction()
    {
        return $this->belongsTo('App\PointsTransaction', 'id');
    }

    public function activityTask()
    {
        return $this->belongsTo('App\ActivityTask');
    }

}
