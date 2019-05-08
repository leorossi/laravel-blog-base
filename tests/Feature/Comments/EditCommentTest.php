<?php

namespace Tests\Feature\Comments;
use App\Comment;
use App\Post;
use App\Role;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditCommentTest extends TestCase
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
    
    public function testUserCanUpdateOwnComment() {
        $role = Role::where('name', 'reader')->first();
        $reader = factory(User::class)->create([
            'role_id' => $role->id
        ]);
        $comment = factory(Comment::class)->create([
            'user_id' => $reader->id,
            'post_id' => $this->post->id
        ]);
    
        $response = $this->actingAs($reader)->put('/api/comments/' . $comment->id, [
            'body' => 'this is a new body'
        ]);
        $this->assertEquals(200, $response->status());
    
        $response = $this->actingAs($reader)->get('/api/posts/' . $this->post->id . '/comments');
        $this->assertEquals(200, $response->status());
        $json = json_decode($response->getContent());
    
        $this->assertEquals(1, count($json));
        $this->assertEquals('this is a new body', $json[0]->body);
    }
    
    public function testUserCannotUpdateOthersComment() {
        $role = Role::where('name', 'reader')->first();
        $reader = factory(User::class)->create([
            'role_id' => $role->id
        ]);
        $comment = factory(Comment::class)->create([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id
        ]);
    
        $response = $this->actingAs($reader)->put('/api/comments/' . $comment->id, [
            'body' => 'this is a new body'
        ]);
        $this->assertEquals(403, $response->status());
    
        $response = $this->actingAs($reader)->get('/api/posts/' . $this->post->id . '/comments');
        $this->assertEquals(200, $response->status());
        $json = json_decode($response->getContent());
    
        $this->assertEquals(1, count($json));
        $this->assertEquals($comment->body, $json[0]->body);
    }
}
