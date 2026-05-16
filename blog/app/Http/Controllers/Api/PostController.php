<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostDetailsResource;
use App\Http\Resources\PostsResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $per_page = request()->query('per_page' , 10);
        $posts = Post::with('author')->paginate($per_page);
        // return response()->json([
        //     'status' => 'success',
        //     'data' => $posts
        // ], 200);

        return PostsResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation
        
        if($request->hasFile('image')){
            $path = $request->file('image')->store('posts', 'public');
        }
        $post = Post::create([...$request->all() , 'image'=> $path ]);
        return response()->json([
            "data"=>$post,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with('author')->find($id);

        if(!$post){
        return response()->json([
            "status" => "failed",
            "message"=> "Not Found" 
        ]);
        }
        return response()->json([
            "status" => "success",
            "data"=> PostDetailsResource::make($post), 
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
