<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'days_food_id'];

    public function user()
    {
        return $this->hasOne(\App\User::class, 'id', 'user_id');
    }

    public function daysFood()
    {
        return $this->hasOne(\App\Models\DaysFood::class, 'id', 'days_food_id');
    }
}
