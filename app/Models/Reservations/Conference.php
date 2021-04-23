<?php

namespace App\Models\Reservations;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Conference extends Model
{
    protected $fillable = ['user_id', 'type', 'subject', 'count', 'catering_type', 'date', 'duration', 'transport', 'status'];

    protected $appends = ['typeText', 'cateringTypeText', 'statusText', 'jDate', 'jCreatedDate'];

    public function getTypeTextAttribute()
    {
        if (is_null($this->attributes['type'])) return '';

        switch ($this->attributes['type']) {
            default:
            case 'conference':
                return 'اتاق جلسه';
            case 'guest':
                return 'ورود مهمان';
        }
    }

    public function getCateringTypeTextAttribute()
    {
        if (is_null($this->attributes['catering_type'])) return '';

        switch ($this->attributes['catering_type']) {
            default:
            case 'type_01':
                return 'درجه ۱';
            case 'type_02':
                return 'درجه ۲';
            case 'type_03':
                return 'درجه ۳';
        }
    }

    public function getStatusTextAttribute()
    {
        if (is_null($this->attributes['status'])) return '';

        switch ($this->attributes['status']) {
            default:
            case 0:
                return 'ثبت شده';
            case 1:
                return 'تایید شده';
            case 2:
                return 'رد شده';
            case 3:
                return 'انجام شده';
        }
    }

    public function getJDateAttribute()
    {
        if (is_null($this->attributes['date'])) return '';

        return Jalalian::forge($this->attributes['date'])->format('Y/m/d H:i:s');
    }

    public function getJCreatedDateAttribute()
    {
        if (is_null($this->attributes['created_at'])) return '';

        return Jalalian::forge($this->attributes['created_at'])->format('Y/m/d H:i:s');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
