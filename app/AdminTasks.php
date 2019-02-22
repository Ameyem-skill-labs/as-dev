<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminTasks extends Model
{
    protected $fillable = ['institutes_id','user_id','worknature', 'subject', 'worktitle', 'workdescription', 'whatinitforme', 'usercredits', 'guidecredits', 'reviewercredits','uploads', 'created_at','updated_at'];
}
