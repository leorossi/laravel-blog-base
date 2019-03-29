@extends('layouts.main')

@section('title', 'Lista Post')

@section('content')
    <div class="float-right">
        @include('posts._search_form')
    </div>
    <div>
        <h1>Posts list</h1>
        @include('posts._posts_list')
    </div>

    <div>
        <h1>Create new post</h1>
        @include('posts.create')
    </div>

@endsection