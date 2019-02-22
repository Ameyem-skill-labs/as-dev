<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTasks extends Model
{
    protected $fillable = ['assigntask_id','request_for','request_by','message','uploads'];
    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
    }
}
