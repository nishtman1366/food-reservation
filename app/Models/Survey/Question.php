<?php

namespace App\Models\Survey;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Question extends Model
{
    protected $fillable = ['title', 'status'];

    protected $appends = ['statusText', 'jDate'];

    public function getStatusTextAttribute()
    {
        return $this->attributes['status'] ? 'فعال' : 'غیرفعال';
    }

    public function getJDateAttribute()
    {
        if (is_null($this->attributes['created_at'])) return '';

        return Jalalian::forge($this->attributes['created_at'])->format('Y/m/d');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id', 'id');
    }
}
