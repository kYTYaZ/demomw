<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
      protected $fillable=["rating","comment","user_id","user_id_m"];
}
