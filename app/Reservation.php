<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
        protected $fillable=["hour","date_reserv","status_id","place_id","asistans"];

      public function assistants(){
            return $this->hasMany("\App\AssistantReservation","user_email","user_email");
      }
    
      public function getAssistants($assistants){
        $assistandArray=array();
        foreach ($assistants as $value) {
            $assistandArray[]= strtolower($value);
        }
        
        
        $user= new User();
        $getUsersByEmail=$user->getUsersByEmail($assistandArray);
       
        $arraynoUsers=array();
       
        return array("users"=>$getUsersByEmail,"nousers"=>$arraynoUsers);
    }
    
    
     public function checkAsistants($arrayEmail,$users){
        $arrayCount=0;
        foreach ($users as $value) {
            if($arrayEmail==$value->email){
                $arrayCount++;
            }
        }
        return $arrayCount;
    }
}
