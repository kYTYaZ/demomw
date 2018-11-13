<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
       public function user(){
        return $this->hasOne("\App\User","id","user_id");
    }
    
    
    public function getUserBySlug($slug){
        return $this
                ->where("slug",$slug)
                ->with("user")
                ->first(); 
    }
}
