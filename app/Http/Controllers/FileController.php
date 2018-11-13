<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Like;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
   
    
    public function upload(Request $request){
        return $request->get("image");
    }
}
