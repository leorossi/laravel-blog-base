@extends('layouts.main')
@section('title', 'Admin - Post List')
@section('content')
    <h1>Post list</h1>
    <table class="table table-striped table-bordered mt-2">
        <thead>
        <th>id</th>
        <th>name</th>
        <th>length</th>
        <th>state</th>
        <th>actions</th>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ strlen($post->body) }}</td>
                <td>{{ $post->state }}</td>
                <td>
                    <div class="btn-group">
                        @if($post->state == 'draft')
                            <form method="POST" action="{{ route('admin-posts.publish', $post) }}">
                                @csrf
                                <button class="btn btn-success">Publish</button>
                            </form>

                        @elseif ($post->state == 'published')
                            <form method="POST" action="{{ route('admin-posts.unpublish', $post) }}">
                                @csrf
                                <button class="btn btn-warning">Un-Publish</button>
                            </form>

                        @endif
                        <a href="{{ route('admin-posts.edit', $post) }}" class="btn btn-primary">edit</a>
                        <form action="{{ route('admin-posts.destroy', $post) }}" method="POST">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger">delete</button>
                        </form>

                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection