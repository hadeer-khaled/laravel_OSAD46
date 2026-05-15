<x-app-layout>
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

    <p>
        Likes: {{ $post->likes()->count() }}
    </p>
    <form action="{{route('posts.like', $post)}}" method="POST">
        @csrf
        <button type="submit"
            class="flex items-center text-gray-500 hover:text-red-600 transition duration-300
                {{ $post->isLikedBy(auth()->user()) ? 'text-red-600' : '' }}
             ">
            <!-- Heart Icon -->
            <svg xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 24 24"
                class="w-6 h-6">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36
                        2 12.28 2 8.5 2 5.42 4.42 3
                        7.5 3c1.74 0 3.41.81 4.5
                        2.09C13.09 3.81 14.76 3
                        16.5 3 19.58 3 22 5.42
                        22 8.5c0 3.78-3.4 6.86-8.55
                        11.54L12 21.35z"/>
            </svg>
            <span class="ml-2">Like</span>
        </button>
    </form>
</x-app-layout>

