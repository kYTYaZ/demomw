<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Feed extends Model
{
    //
    
    public function user(){
        return $this->hasOne("\App\User","id","user_id")->with("profile");
    }
    
    public function likes(){
        return $this->hasMany("\App\Like","source_id","id")->where("source_type",1);
    }
    
     public function canDeletePosts(){
        return $this->hasMany("\App\User","id","user_id")->where("users.id",Auth::id());
    }
    
      
    public function likesPeople(){
        return $this->hasMany("\App\Like","source_id","id")->where("source_type",1)->with("user")->limit(6);
    }
    
    
       
    public function comments(){
        return $this->hasMany("\App\Comment","source_id","id")
                ->with("user")
                ->withCount("likes")
                ->withCount("canDeleteComments")
                ->orderBy("created_at","desc")
                ;
    }
    
       
    
       
    public function attachment(){
        return $this->hasOne("\App\FeedAttachment","feed_id","id");
    }
    
    public function getFeedById($feed){
        return $this->where("id",$feed)
                ->with("user")
                ->withCount("likes")
                ->withCount("comments")
                ->withCount("canDeletePosts")
                ->with("comments")
                ->with("attachment")
                ->first();
    }
    
    
    public function getFeed($request){
                $query = Feed::query();

                $query->with("user");
                $query->withCount("likes");
                $query->with("likesPeople");
                $query->with("attachment");
                $query->with("comments");
                $query->withCount("comments");
                $query->withCount("canDeletePosts");
                if($request->get("user")>0){
                    $query->where("user_id",$request->get("user"));
                }
                $query->orderBy("created_at","desc");
        
        return $query->paginate(5);
    }
    
    
   public function getCreatedAtAttribute($value)
 {
     return date("c", strtotime($value));
 }

}
