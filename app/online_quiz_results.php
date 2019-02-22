<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class online_quiz_results extends Model
{
    protected $fillable = ['user_id','quiz_id','score','total'];
}
