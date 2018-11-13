<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Like= new Like();
        $getLikeBySourceAndTypeAndUser=$Like->getLikeBySourceAndTypeAndUser($request->get("like_type"), $request->get("id"), Auth::id());
        
        if($getLikeBySourceAndTypeAndUser==0){
             $Like->user_id=Auth::id();
            $Like->source_type=$request->get("like_type");
            $Like->source_id=$request->get("id");
            $Like->save();
        }else{
            $Like->deleteLikeBySourceAndTypeAndUser($request->get("like_type"), $request->get("id"), Auth::id());
        }
        
        $getLikeBySourceAndType= $Like->getLikeBySourceAndType($request->get("like_type"), $request->get("id"));
        $countLikeBySourceAndType=$Like->countLikeBySourceAndType($request->get("like_type"), $request->get("id"));
        return array("likes_people"=>$getLikeBySourceAndType,"likes_count"=>$countLikeBySourceAndType);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
