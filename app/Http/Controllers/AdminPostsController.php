<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class AdminPostsController extends Controller {
    public function index() {
        $posts = Post::all();
        return view('admin.posts.index', [
            'posts' => $posts
        ]);
    }
    
    public function publish($id) {
        $post = Post::findOrFail($id);
        $post->state = 'published';
        $post->save();
        return redirect(route('admin-posts.index'));
    }
    
    public function unpublish($id) {
        $post = Post::findOrFail($id);
        $post->state = 'draft';
        $post->save();
        return redirect(route('admin-posts.index'));
    }
    
    public function edit($id)
    {
        $post = Post::findorfail($id);
        return view('admin.posts.edit', [ 'post' => $post ]);
    }
    
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();
        return redirect(route('admin-posts.index'));
    }
}