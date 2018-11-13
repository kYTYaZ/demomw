<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Friend;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $friends = new Friend();
        $getUserFriends = $friends->getUserFriends($request->get("user_id"));

        return $getUserFriends;
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    public function deleteFriend(Request $request) {
        $Friend = new Friend();
        $findFriendByIdAndUser = $Friend->findFriendByIdAndUser($request->get("user_id"), Auth::id());

        if ($findFriendByIdAndUser) {
            $findFriendByIdAndUser->delete();
            $countUserFriends = $Friend->countUserFriends(Auth::id());


            $FriendFrom = new Friend();
            $findFriendByIdAndUserFrom = $FriendFrom->findFriendByIdAndUser(Auth::id(), $request->get("user_id"));
            if($findFriendByIdAndUserFrom){
                $findFriendByIdAndUserFrom->delete();
            }

            return array("response" => true, "message" => "Eliminaste el usuario con éxito", "data" => array("friends_count" => $countUserFriends));
        } else {
            return array("response" => false, "message" => "El usuario no es tu amigo");
        }
    }

    public function addFriend(Request $request) {


        $Friend = new Friend();
        $findFriendByIdAndUser = $Friend->findFriendByIdAndUser($request->get("user_id"), Auth::id());
        if (!$findFriendByIdAndUser) {
            $Friend = new Friend();
            $Friend->user_id = Auth::id();
            $Friend->friend_id = $request->get("user_id");
            $Friend->status = 2;
            $Friend->save();


            $Friend = new Friend();
            $Friend->user_id = $request->get("user_id");
            $Friend->friend_id = Auth::id();
            $Friend->status = 2;
            $Friend->save();

            return array("response" => true, "message" => "Agregaste el usuario con éxito");
        }
        return array("response" => false, "message" => "El usuario  ya es tu amigo");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
