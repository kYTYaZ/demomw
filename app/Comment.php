<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
      
    public function user(){
        return $this->hasOne("\App\User","id","user_id")->with("profile");
    }
    
      
    public function likes(){
        return $this->hasMany("\App\Like","source_id","id")->where("source_type",2);
    }
    
    
    public function canDeleteComments(){
        return $this->hasMany("\App\User","id","user_id")->where("users.id",Auth::id());
    }
    
    
    public function typeAndResource($source_id,$source_type){
        return $this
                ->where("source_id",$source_id)
                ->where("type_source",$source_type)
                ->count();
    }
    
      public function getCommentById($feed){
        return $this->where("id",$feed)
                ->with("user")
                ->with("likes")
                                ->withCount("likes")

                ->first();
    }
    
      public function getCreatedAtAttribute($value)
 {
     return date("c", strtotime($value));
 }
    
}
