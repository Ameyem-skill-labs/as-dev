<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chapterstatuses extends Model
{
    public function  chapter(){
        return $this->belongsTo('App\chapter');
     }
 
 
     protected $fillable = [
         'user_id','chapter_id','status'
     ];
     
}
