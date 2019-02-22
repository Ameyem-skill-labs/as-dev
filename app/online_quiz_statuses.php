<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class online_quiz_statuses extends Model
{
    protected $fillable = ['online_quiz_question_id','user_id','user_answer','result'];
}
