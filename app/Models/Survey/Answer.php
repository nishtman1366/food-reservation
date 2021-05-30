<?php

namespace App\Models\Survey;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['question_id', 'answer'];

    public function userAnswers()
    {
        return $this->hasMany(UsersAnswer::class, 'answer_id', 'id');
    }
}
