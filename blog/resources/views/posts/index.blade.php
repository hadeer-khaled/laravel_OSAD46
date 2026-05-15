<x-app-layout>

    <h1> Posts List </h1>
    <ul>
        @foreach($posts as $post)
            <li>
                Title: {{$post->title}}
            </li>
            <li>
                Created At: {{$post->created_at}}
            </li>
        @endforeach
        <a href="{{ route('posts.create') }}">
            <x-button className="btn btn-primary">
                Create New Post
            </x-button>
        </a>
    </ul>

</x-app-layout>
