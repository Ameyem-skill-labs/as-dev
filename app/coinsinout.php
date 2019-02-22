<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class coinsinout extends Model
{
 
     protected $fillable = [
        'user_id',
        'nature_id',
        'enrollment_id',
        'coins',
     ];
     
}