<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Feed;
use Illuminate\Support\Facades\Auth;
use \App\FeedAttachment;



class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }
    
    public function feedWall(Request $request){
        
         $Feed= new Feed();
        $getFeed=$Feed->getFeed($request);
        return $getFeed;
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
        
        $Feed= new Feed();
        $Feed->user_id=Auth::id();
        $Feed->text=$request->get("message");
        $Feed->type=1;
        $Feed->save();
        $getFeedById=$Feed->getFeedById($Feed->id);
        return $getFeedById;
    }

    public function feedAattachment(Request $request){
 
        $Feed= new Feed();
        $Feed->user_id=Auth::id();
        $Feed->text=$request->get("message");
        $Feed->type=$request->get("type");
        $Feed->save();
        
        $FeedAttachment= new FeedAttachment();
        $FeedAttachment->description=$request->get("description");
        $FeedAttachment->image=$request->get("image");
        $FeedAttachment->site=$request->get("site");
        $FeedAttachment->title=$request->get("title");
        $FeedAttachment->type=$request->get("type");
        $FeedAttachment->url=$request->get("url");
        $FeedAttachment->feed_id=$Feed->id;
        $FeedAttachment->save();
                
                
                
        $getFeedById=$Feed->getFeedById($Feed->id);
        return $getFeedById;
        
        return $request->all();
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
        
        $Feed= Feed::find($id);
        if($Feed->user_id==Auth::id()){
             if($Feed->delete()){
                 return 1;
             }
        }
        return 0;
    }
}
