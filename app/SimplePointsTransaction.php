<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SimplePointsTransaction extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'concept'
    ];

    public function transaction()
    {
        return $this->belongsTo('App\PointsTransaction', 'id');
    }

}
