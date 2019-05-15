<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\CreatePostRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostsController extends BaseApiController
{
    public function __construct()
    {
        $this->middleware('auth:api')->only(['store', 'update', 'destroy']);
    }
    
    public function index()
    {
        // gets all posts
        return $this->success(Post::all());
    }
    
    public function store(CreatePostRequest $request)
    {
        abort_if(Gate::denies('create-posts'), 403);
        $post = new Post($request->all());
        $post->user()->associate(auth()->user());
        $post->save();
        return $this->success($post);
    }

    public function show(Post $post)
    {
        $this->authorize('show', $post);
        return $this->success($post);
    }
    

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $post->update($request->all());
        return $this->success($post);
    }

    public function destroy(Post $post)
    {
        $this->authorize('destroy', $post);
        $post->delete();
        return $this->success([]);
        
    }
    
    public function forUser() {
        $user = Auth::user();
        return $this->success($user->posts);
    }
}
