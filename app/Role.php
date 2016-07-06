<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display_name', 'description'
    ];

    public function getPermListAttribute()
    {
        return $this->perms->pluck('id')->toArray();
    }

}
