<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Way 1 - Query Builder
        $posts = DB::table('posts')->get();  
        // $posts = DB::table('posts')->latest()->get();  // return collection of posts (objects)

        //ORM (Eloquent)
        // $posts = Post::all();
        return view('posts.index', ['posts' => $posts] );
        // return view('posts.index', compact('posts') ); //['posts' => $posts]
    }

    public function create()
    {
        // Post::factory()->create(); // create a post using factory

        return view('posts.create');        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //store data in database

        // Way 1 - Query Builder
        // DB::table('posts')->insert([
        //     'title' => $request['title'],
        //     'content' => $request['content'],
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);


        //Way 2 - ORM (Eloquent)
        // $post = new Post();
        // $post->title = $request['title'];
        // $post->content = $request['content'];
        // $post->save();


        //Way 3 - ORM Eloquent (Mass Assignment)
        $post = Post::create([
            'title' => $request['title'],
            'content' => $request['content'],
        ]);

        // add password
        // $post->password = bcrypt($request['password']);
        // $post->save();

        return redirect()->route('posts.index')->with('success', 'Post created successfully');

        // return 'Post created successfully with title: ' . $request->input('title') . ' and content: ' . $request->input('content');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {

        // Way 1 - Query Builder
        // $post = DB::table('posts')->where('id', $id)->first();  // return single post (object)
        // $post = DB::table('posts')->find($id);  // return single post (object)

        // Way 2 - ORM (Eloquent)
        $post = Post::with('author')->find($id);  // return single post (object)
        if(!$post) {
            return 'Post not found';
        }
        // return $post;
        
        return view('posts.show', ['post' => $post] );

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
