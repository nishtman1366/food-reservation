<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class DaysFood extends Model
{
    protected $table = 'days_foods';

    protected $fillable = ['date', 'food_id'];

    protected $appends = ['jDate','weekday'];

    public function getJDateAttribute()
    {
        return Jalalian::forge($this->attributes['date'])->format('Y/m/d');
    }

    public function getWeekdayAttribute()
    {
        return Jalalian::forge($this->attributes['date'])->format('%A');
    }
    public function food()
    {
        return $this->hasOne(\App\Models\Food::class, 'id', 'food_id');
    }
}
