<x-app-layout>
    <form action="/posts" method="POST">
        @csrf
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="{{old('title')}}"><br>
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="content">Content:</label><br>
        <textarea id="content" name="content">{{ old('content') }}</textarea><br>
        @error('content')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="submit" value="Submit">
    </form>
</x-app-layout>
