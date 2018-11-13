<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
        protected $fillable=["name"];

    public function getByName($name){
        return $this
                ->select("name","id","lat","lng")
                ->where("name","like","%".$name."%")
                ->get();
    }
}
