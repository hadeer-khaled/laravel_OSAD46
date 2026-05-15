<x-app-layout>

    <h1> Posts List </h1>
    <ul>
        @foreach($posts as $post)
            <li>
                {{$post->title}}
            </li>
        @endforeach
        <a href="{{ route('posts.create') }}">
            <x-button className="btn btn-primary">
                Create New Post
            </x-button>
        </a>
    </ul>

</x-app-layout>
