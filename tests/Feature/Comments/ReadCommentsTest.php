<?php

namespace Tests\Feature\Comments;
use App\Comment;
use App\Post;
use App\Role;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadCommentsTest extends TestCase
{
    use RefreshDatabase;
    
    protected function setUp(): void
    {
        parent::setUp();
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
    
    public function testAllUsersCanGetCommentList() {
        $comments = factory(Comment::class, 10)->create([
            'post_id' => $this->post->id,
            'user_id' => $this->user->id
        ]);
        
        $getResponse = $this->get('/api/posts/' . $this->post->id . '/comments');
        $this->assertEquals(200, $getResponse->getStatusCode());
        $json = json_decode($getResponse->getContent());
        $this->assertEquals(10, count($json));
    }
    
    
}
