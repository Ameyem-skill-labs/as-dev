<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignTasks extends Model
{
    protected $fillable = ['assigned_by_userid','task_id', 'user_id', 'guide_id', 'reviewer_id','course_chapter_id', 'status','guide_credits','reviewer_credits','target_at','completed_at'];
}
