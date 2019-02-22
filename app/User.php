<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use Vinkla\Hashids\Facades\Hashids;

use Spatie\Permission\Traits\HasRoles;
use Hash;

/**
 * Class User
 *
 * @package App
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
*/
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $fillable = ['name',
    'first_name',
    'last_name',
    'roll_number',
    'email',
    'password',
    'activated',
    'token',

    'institutes_id','role_id','branch_id','batch_id','phone_number','dob',
'qualification','specialization','marks','passout','collegeaddress','homeaddress'
,'profilepic',

    'signup_ip_address',
    'signup_confirmation_ip_address',
    'signup_sm_ip_address',
    'admin_ip_address',
    'updated_ip_address',
    'deleted_ip_address','type','status',];
    
    protected $hidden = [
        'password',
        'remember_token',
        'activated',
        'token','type','status',
    ];
    
    /**
     * Hash password
     * @param $input
     */
    public function setPasswordAttribute($input)
    {
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }
    
    
    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }
    
    
    
    protected $dates = [
        'deleted_at',
    ];

    /**
     * Build Social Relationships.
     *
     * @var array
     */
    public function social()
    {
        return $this->hasMany('App\Models\Social');
    }

    /**
     * User Profile Relationships.
     *
     * @var array
     */
    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    // User Profile Setup - SHould move these to a trait or interface...

    public function profiles()
    {
        return $this->belongsToMany('App\Models\Profile')->withTimestamps();
    }

    public function hasProfile($name)
    {
        foreach ($this->profiles as $profile) {
            if ($profile->name == $name) {
                return true;
            }
        }

        return false;
    }

    public function assignProfile($profile)
    {
        return $this->profiles()->attach($profile);
    }

    public function removeProfile($profile)
    {
        return $this->profiles()->detach($profile);
    }
    
    //For tutApp
    /*relate an user to a cv*/
    public function cv(){
        return $this->hasOne('App\cv');
    }

    /*One mentor can have many courses */
    public  function course(){
        return $this->hasMany('App\course');
    }

    public function enrollment(){
        return $this->hasMany('App\enrollment','student_id');
    }

    public function forumQuestion(){
        return $this->hasMany('App\forumQuestion');
    }

    public function getEnrolledCourseAttribute(){
        return $this->enrollment->course;
    }
}
