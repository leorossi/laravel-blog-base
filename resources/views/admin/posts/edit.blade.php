@extends('layouts.main')

@section('content')
    <h1>Edit post #{{ $post->id }}</h1>
    <form action="{{ route('admin-posts.update', $post) }}" method="POST" class="form">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="name">Title:</label>
            <input type="text" class="form-control" name="title" value="{{ $post->title }}">
        </div>

        <div class="form-group">
            <label for="name">Body:</label>
            <textarea class="form-control" name="body">{{ $post->body }}</textarea>
        </div>

        <div class="form-group">
            <button class="btn btn-success">Save</button>
        </div>
    </form>
@endsection