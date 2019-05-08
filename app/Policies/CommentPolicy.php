<?php

namespace App\Policies;

use App\Comment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    public function destroy(User $user, Comment $comment) {
        return ($user->is('editor') && $comment->post->user_id == $user->id
            || $user->is('reader') && $comment->user_id == $user->id);
        
    }
    
    public function edit(User $user, Comment $comment) {
        return $user->is('reader') && $comment->user_id == $user->id;
    }
}
