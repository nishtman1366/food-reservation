<?php

namespace App\Models\Survey;

use Illuminate\Database\Eloquent\Model;

class UsersAnswer extends Model
{
    protected $fillable = ['user_id', 'answer_id'];
}
