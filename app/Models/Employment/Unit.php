<?php

namespace App\Models\Employment;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'user_units';

    protected $fillable = ['name'];
}
