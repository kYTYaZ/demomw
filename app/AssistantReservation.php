<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AssistantReservation extends Model
{
    protected $fillable=["user_email","place_id"];
    public function user(){
        return $this->hasOne("\App\User","id","user_id");
    }
  
}
