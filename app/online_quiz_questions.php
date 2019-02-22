<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class online_quiz_questions extends Model
{
    protected $fillable = ['question','optionA','optionB','optionC','optionD','answer','online_quiz_id'];
}
