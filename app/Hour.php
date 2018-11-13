<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    protected $fillable=["hour_open","hour_close","order_hour"];
}
