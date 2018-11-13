<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    
    
       public function profile(){
        return $this->hasOne("\App\Profile","user_id","id");
    }
    
    
     
    public function friends(){
        return $this->hasMany("\App\Friend","user_id","id");
    }
    
    
    public function getCountFriend(){
        
    }
    
        
    public function getUsersByEmail($emails){
        return $this->whereIn("email",$emails)->get();
    }
    
     public function getUserByEmail($emails){
        return $this->where("email",$emails)->first();
    }
    
    
}
