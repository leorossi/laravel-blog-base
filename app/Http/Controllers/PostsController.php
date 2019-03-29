<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function create() {
        return view('posts.create');
    }
    
    public function store() {
        $request = request();
        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->state = 'draft';
        $post->save();
        dd($post);
        return redirect( route('posts.index') );
        
    }
    
    public function index(Request $request) {
        $term = $request->query('query');
        
        if ($term) {
            $posts = Post::where('title', 'LIKE', '%' . $term . '%')
                ->orderBy('title')
                ->published()
                ->get();
            $posts->appends('query', $term);
        } else {
            $posts = Post::published()->get();
        }
        
        return view('posts.index', [
            'posts' => $posts
        ]);
    }
    
    public function show($postId) {
        $post = Post::find($postId);
        return view('posts.show', [
            'post' => $post
        ]);
    }
    
    public function edit($postId) {
        $post = Post::find($postId);
        return view('posts.edit', [
            'post' => $post
        ]);
    }
    
    public function update($postId) {
        $post = Post::find($postId);
    }
    
}
