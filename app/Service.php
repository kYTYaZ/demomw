<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable=["name","icon"];
    public function searchByName($name){
        return $this->where("name",$name)->first();
    }
}
