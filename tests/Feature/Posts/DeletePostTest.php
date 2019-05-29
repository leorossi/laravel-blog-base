<?php

namespace Tests\Feature;

use App\Post;
use App\Role;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeletePostTest extends TestCase
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
    }
    
    public function testUserCanDeleteOwnPost() {
        $post = factory(Post::class)->create([
            'user_id' => $this->user->id
        ]);
        
        $deleteResponse = $this->actingAs($this->user, 'api')
            ->delete('/api/posts/' . $post->id);
        $this->assertEquals(200, $deleteResponse->getStatusCode());
        
        $getPostsResponse = $this->actingAs($this->user, 'api')
            ->get('/api/users/' . $this->user->id . '/posts');
        $this->assertEquals(200, $getPostsResponse->getStatusCode());
        $json = json_decode($getPostsResponse->getContent());
        $this->assertEquals(0, count($json));
    }
    
    public function testUserCannotDeleteOthersPost() {
        $role = Role::where('name', 'editor')->first();
        $otherUser = $user = factory(User::class)->create([
            'role_id' => $role->id
        ]);
        $post = factory(Post::class)->create([
            'user_id' => $otherUser
        ]);
    
        $deleteResponse = $this->actingAs($this->user, 'api')
            ->delete('/api/posts/' . $post->id);
        
        $this->assertEquals(403, $deleteResponse->getStatusCode());
    }
}
