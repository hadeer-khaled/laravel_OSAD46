<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Dom\Comment;
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
        // $posts = DB::table('posts')->get();  
        // $posts = DB::table('posts')->latest()->get();  // return collection of posts (objects)

        //ORM (Eloquent)
        $posts = Post::all(); //return all where deleted_at is null (not deleted)
        // $posts = Post::withTrashed()->get(); // return post even if it is soft deleted
        // $posts = Post::onlyTrashed()->get(); // return only soft deleted posts



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
    public function store(StorePostRequest $request)
    {

        // dd($request->all());

        $validatedArray = $request->validated();

        if($request->hasFile('image')){
            $path = $request->file('image')->store('posts', 'public');
            $validatedArray['image'] = $path;
        }
        Post::create($validatedArray); 


        //------------------------------------------------

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
        // $post = Post::create([
        //     'title' => $request['title'],
        //     'content' => $request['content'],
        // ]);

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

        $post = Post::findOrFail($id); // return post if found else throw 404 error
        
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
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }

    public function addComment(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'content' => 'required|string',
        ]);

        $post->comments()->create([
            'content' => $validatedData['content'],
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Comment added successfully');
    }

    public function like(Post $post)
    {
        if($post->isLikedBy(auth()->user()))
        {
            $post->likes()->where('user_id', auth()->id())->delete();
        }else
        {
            $post->likes()->create(['user_id' => auth()->id()]);

        }
        return redirect()->route('posts.show', $post)->with('success', 'Post liked successfully');
    }


}
