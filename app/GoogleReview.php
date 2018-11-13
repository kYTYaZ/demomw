<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoogleReview extends Model
{
      protected $fillable=["author_name","author_url","language","profile_photo_url","rating","relative_time_description","text","time"];
}
