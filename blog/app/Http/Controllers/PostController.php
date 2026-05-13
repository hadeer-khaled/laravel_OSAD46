<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all posts from database
        $posts = [
            ['id' => 1, 'title' => 'First Post', 'content' => 'This is the first post.'],
            ['id' => 2, 'title' => 'Second Post', 'content' => 'This is the second post.'],
            ['id' => 3, 'title' => 'Third Post', 'content' => 'This is the third post.'],
        ];

        return view('posts.index', ['posts' => $posts] );
        // return view('posts.index', compact('posts') ); //['posts' => $posts]
    }

    public function create()
    {
        return view('posts.create');        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //store data in database
        return 'Post created successfully with title: ' . $request->input('title') . ' and content: ' . $request->input('content');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        // get details of one post
        $posts = [
            ['id' => 1, 'title' => 'First Post', 'content' => 'This is the first post.'],
            ['id' => 2, 'title' => 'Second Post', 'content' => 'This is the second post.'],
            ['id' => 3, 'title' => 'Third Post', 'content' => 'This is the third post.'],
        ];

        foreach ($posts as $post) {
            if ($post['id'] == $id) {
                return view('posts.show', ['post' => $post]);
            }
        }

        return 'Post not found';
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
