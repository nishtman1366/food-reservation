<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Popup extends Model
{
    protected $fillable = ['title', 'body', 'start', 'end'];

    protected $appends = ['startJDate', 'endJDate', 'date'];

    public function getStartJDateAttribute()
    {
        return Jalalian::forge($this->attributes['start'])->format('Y/m/d H:i:s');
    }

    public function getEndJDateAttribute()
    {
        return Jalalian::forge($this->attributes['end'])->format('Y/m/d H:i:s');
    }


    public function getDateAttribute()
    {
        return Jalalian::forge($this->attributes['created_at'])->format('Y/m/d');
    }
}
