<?php

namespace App\Providers;

use App\Comment;
use App\Policies\CommentPolicy;
use App\Policies\PostPolicy;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        Comment::class => CommentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        Gate::define('create-posts', function(User $user) {
            return $user->role->name == 'editor' || $user->role->name == 'admin';
        });
    
        Gate::define('create-comments', function(User $user) {
            // all users can comment;
            return !is_null($user->id);
        });
    }
    
    
}
