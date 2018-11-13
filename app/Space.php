<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    protected $fillable=["name","icon"];
    public function searchByName($name){
        return $this->where("name",$name)->first();
    }
}
