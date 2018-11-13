<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  \App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
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
        
        $Comment= new Comment();
        $Comment->user_id=Auth::id();
        $Comment->comment=$request->get("comment");
        $Comment->type_source=$request->get("source_type");
        $Comment->source_id=$request->get("source_id");
        $Comment->save();
        $typeAndResource=$Comment->typeAndResource($request->get("source_id"), $request->get("source_type"));
        $getCommentById=$Comment->getCommentById($Comment->id);
        
        $canDelete=0;
        if($Comment->user_id==Auth::id()){
            $canDelete=1;
        }
        $getCommentById->can_delete_comments_count=$canDelete;
        return array("comment"=>$getCommentById,"comments_count"=>$typeAndResource,"can_delete_comments_count"=>$canDelete);
    }

    public function getCommentsBySourceAndType(Request $request){
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
        $Comment= Comment::find($id);
        if($Comment->user_id==Auth::id()){
             if($Comment->delete()){
                 return 1;
             }
        }
        return 0;
    }
}
