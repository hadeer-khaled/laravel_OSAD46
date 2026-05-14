@extends('layouts.master')

@section('title', 'Posts List')

@section('content')
    <h1> Posts List </h1>
    <ul>
        @foreach($posts as $post)
            <li>
                {{$post['title']}}
                <x-button className="btn btn-primary">
                    Create New Post
                </x-button>
            </li>
        @endforeach
    </ul>
@endsection
