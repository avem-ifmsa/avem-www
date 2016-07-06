<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MbMemberPeriod extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start', 'end'
    ];

    /**
     * Additional fields to treat as Carbon instances.
     *
     * @var array
     */
    protected $dates = [
        'start', 'end'
    ];

    public function mbCharge()
    {
        return $this->belongsTo('App\MbCharge');
    }

    public function mbMember()
    {
        return $this->belongsTo('App\MbMember');
    }

    public function setStartAttribute($datetime)
    {
        $this->attributes['start'] = $datetime ?: Carbon::parse($datetime);
    }

    public function setEndAttribute($datetime)
    {
        $this->attributes['end'] = $datetime ?: Carbon::parse($datetime);
    }

    public function scopeActive($query)
    {
        $now = Carbon::now();
        $query->where('start', '<=', $now)
              ->where('end', '>', $now);
    }

}
