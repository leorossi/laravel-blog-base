<?php

namespace Tests\Feature\Comments;

use App\Comment;
use App\Post;
use App\Role;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteCommentTest extends TestCase
{
    use RefreshDatabase;
    public $user;
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed([\RolesTableSeeder::class]);
        $role = Role::where('name', 'editor')->first();
        $this->user = $user = factory(User::class)->create([
            'role_id' => $role->id
        ]);
        $this->post = factory(Post::class)->create([
            'user_id' => $this->user->id
        ]);
        
    }
    
    public function testUserCanDeleteOwnComment() {
        $role = Role::where('name', 'reader')->first();
        $reader = factory(User::class)->create([
            'role_id' => $role->id
        ]);
        $comment = factory(Comment::class)->create([
            'user_id' => $reader->id,
            'post_id' => $this->post->id
        ]);
    
        $response = $this->actingAs($reader)->delete('/api/comments/' . $comment->id);
        $this->assertEquals(200, $response->status());
    }
    
    public function testUserCannotDeleteOthersComment() {
        $role = Role::where('name', 'reader')->first();
        $reader = factory(User::class)->create([
            'role_id' => $role->id
        ]);
        $comment = factory(Comment::class)->create([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id
        ]);
    
        $response = $this->actingAs($reader)->delete('/api/comments/' . $comment->id);
        $this->assertEquals(403, $response->status());
    
        $response = $this->actingAs($reader)->get('/api/posts/' . $this->post->id . '/comments');
        $this->assertEquals(200, $response->status());
        $json = json_decode($response->getContent());
    
        $this->assertEquals(1, count($json));
        
    }
}
