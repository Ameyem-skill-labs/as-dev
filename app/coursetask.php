<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class coursetask extends Model
{
    public function  chapter(){
       return $this->belongsTo('App\chapter');
    }


    protected $fillable = [
        'chapter_id','task_id','time_required'
    ];
    
    
}
