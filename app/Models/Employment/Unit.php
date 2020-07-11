<?php

namespace App\Models\Employment;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'user_units';

    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(\App\User::class, 'user_units_id', 'id');
    }
}
