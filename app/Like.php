<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function getLikesBySource($source_id){
        return $this->where("source_id",$source_id)->count();
    }
    
      public function user(){
        return $this->hasOne("\App\User","id","user_id");
    }
    
    
    public function getLikeBySourceAndTypeAndUser($source_type,$source_id,$user_id){
        return $this
                ->where("source_type",$source_type)
                ->where("source_id",$source_id)
                ->where("user_id",$user_id)
                ->count();
    }
    
    
      public function getLikeBySourceAndType($source_type,$source_id){
        return $this
                ->where("source_type",$source_type)
                ->where("source_id",$source_id)
                ->with("user")
                ->limit(6)
                ->get();
    }
     public function countLikeBySourceAndType($source_type,$source_id){
        return $this
                ->where("source_type",$source_type)
                ->where("source_id",$source_id)
                ->count();
    }
    
     public function deleteLikeBySourceAndTypeAndUser($source_type,$source_id,$user_id){
        return $this
                ->where("source_type",$source_type)
                ->where("source_id",$source_id)
                ->where("user_id",$user_id)
                ->delete();
    }
}
