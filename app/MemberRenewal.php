<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberRenewal extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'until'
    ];

    /**
     * Additional fields to treat as Carbon instances.
     *
     * @var array
     */
    protected $dates = [
        'until'
    ];

    public function member()
    {
        return $this->belongsTo('App\Member');
    }

    public function applier()
    {
        return $this->belongsTo('App\MbMember', 'applied_by');
    }

}
