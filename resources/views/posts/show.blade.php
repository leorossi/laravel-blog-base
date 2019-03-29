@extends('layouts.main')

@section('custom-header')
    <script type="text/javascript" src="{{ asset('js/small.js') }}"></script>
@endsection
@section('title', $post->title)
@section('content')
    <h1>{{ $post->title }}</h1>

    <p>{{ $post->body }}</p>

    <a href="{{ route('posts.index') }}" class="btn btn-warning">back</a>


    <img src="{{ asset('images/stock-image.png') }}" alt="">
@endsection