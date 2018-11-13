<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Profile;
use Illuminate\Support\Facades\Auth;
use \App\Friend;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $Profile= new Profile();
        $getUserBySlug=$Profile->getUserBySlug($slug);
        $getUserBySlug->friend=false;
        if($getUserBySlug->user_id==Auth::id()){
            $getUserBySlug->ownProfile=true;
        }else{
            $getUserBySlug->ownProfile=false;
            $friend= new Friend();
            $findFriendByIdAndUser=$friend->findFriendByIdAndUser($getUserBySlug->user_id, Auth::id());
            if($findFriendByIdAndUser){
                $getUserBySlug->friend=true;
            }
         }
         return view('profile.index')->with("profile",$getUserBySlug);
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
        //
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
