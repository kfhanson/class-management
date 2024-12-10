<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PDO;

class User extends Authenticatable
{
    use Notifiable;

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function roles(){
        return $this->belongsToMany(Role::class, 'role_users', 'user_id', 'role_id');
    }

    public function hasAnyRole($roles){
        if(is_array($roles)) {
            foreach($roles as $role){
                if($this->hasRole($role)){
                    return true;
                }
            }
        }else{
            if($this->hasRole($roles)){
                return true;
            }
        }
        return false;
    }

    public function hasRole($role){
        if(auth()->user()->roles()->first()->slug == $role){
            return true;
        }
        return false;
    }


    protected $fillable = [
        'name',
        'email',
        'password',
        'pin_code',
    ];

    protected $hidden = [
        'pin_code',
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
