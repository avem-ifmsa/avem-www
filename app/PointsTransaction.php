<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PointsTransaction extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'points', 'applied_at'
    ];

    public function member()
    {
        return $this->belongsTo('App\Member');
    }

    public function applier()
    {
        return $this->belongsTo('App\MbMember', 'mb_member_id');
    }

}
