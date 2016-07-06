<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MbCharge extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'email'
    ];

    public function periods() {
        return $this->hasMany('App\MbMemberPeriod');
    }

}
