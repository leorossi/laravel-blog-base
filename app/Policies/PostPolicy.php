<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    
    public function show(User $user, Post $post) {
        $isOwner = $this->touch($user, $post);
        return $isOwner || $post->state == 'published';
    }
    
    public function update(User $user, Post $post) {
        return $this->touch($user, $post);
    }
    
    public function destroy(User $user, Post $post) {
        return $this->touch($user, $post);
    }
    
    public function touch(User $user, Post $post) {
        return $post->user_id == $user->id;
    }
    
    public function comment(User $user, Post $post) {
        return $post->state == 'published';
    }
}
