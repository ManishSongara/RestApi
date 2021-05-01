<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;
use Intervention\Image\ImageManagerStatic as Image;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     
        $posts = new post([
            'userid' => $request->u_id,
            'post_contant' => $request->caption,
            'image_path' => $request->imgPath,
        ]);

        $posts->save();

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $posts = new post([
            'userid' => $request->u_id,
            'category' => $request->category,
            'img_path'=> $request->img_path,
            'painter_name' => $request->painter_name,
            'msg' => $request->msg, //caption
            'prise' => $request->prise,
            'city' => $request->city,
        ]);

        $posts->save();

        return response()->json([
            'message' => 'Successfully created user!',
            'post' => $posts
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $path = "F:/code/social-site/social_network_frontend/assets/images";
        $request->validate([
            'photo' => 'required',
        ]);
        $photo = $request->input('photo');
        // Log::debug("Hello there".$photo);
        $photo = str_replace('data:image/png;base64,', '', $photo);
        // $photo = str_replace(' ', '+', $photo);
        $image = base64_decode($photo);
        // Log::debug("Hello there".$image);
        $imageName = "abc".'.'.'jpg';
        Storage::disk('public')->put('images/'.$imageName, $image);
        
        return  response()->json([
            'msg' => 'success',
            'file' =>  $imageName,
            'path' => "images".'/'.$imageName
        ]);
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
