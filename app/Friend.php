<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    public function findFriendByIdAndUser($friend,$user){
        return $this
                ->where("friend_id",$friend)
                ->where("user_id",$user)
                ->first();
    }
    
    
       public function user(){
        return $this->hasOne("\App\User","id","friend_id")->withCount("friends");
    }
    
    
      public function getUserFriends($user){
          
        return $this
                ->with("user")
                ->where("user_id",$user)
                ->paginate(20);
    }
    
    public function countUserFriends($user){
          
        return $this
                ->where("user_id",$user)
                ->count();
    }
}
