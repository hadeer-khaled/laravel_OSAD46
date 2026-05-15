<!DOCTYPE html>
<html>
<head>
    <title>Posts</title>
</head>
<body> 
    <h1> posts </h1>
    <ul>
            <li>Post ID: {{$post->id}}</li>
            <li>Post Title: {{$post->title}}</li>
            <li>Post Content: {{$post->content}}</li>
            <li>Post Author: {{$post->author->name}}</li>
            <li>Post Imageeee: {{$post->image}}</li>

            @if($post->image)
            <li>Post Image: 
                <img src="{{asset('storage/' . $post->image)}}" alt="Post Image" width="200">
            </li>
            @endif
    </ul>
    <div>
        <h2>Comments:</h2>
        <ul>
            @foreach($post->comments as $comment)
                <li>{{ $comment->content }}</li>
            @endforeach
        </ul>

    <form action="{{route('posts.comments.store', $post)}}" method="POST">
        @csrf
        <div>
            <label for="content">Add Comment:</label>
            <textarea name="content" id="content"></textarea>
        </div>
        <button type="submit">Submit Comment</button>
    </form>
</body>      
</html>
