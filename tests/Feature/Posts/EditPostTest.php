<?php

namespace Tests\Feature;

use App\Post;
use App\Role;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditPostTest extends TestCase
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
    
    public function testUserCanUpdateOwnPost() {
        $post = factory(Post::class)->create([
            'user_id' => $this->user->id
        ]);
        
        $updateResponse = $this->actingAs($this->user)
            ->put('/api/posts/' . $post->id, [
                'title' => 'A new title'
            ]);
        $this->assertEquals(200, $updateResponse->getStatusCode());
        
        $getPostsResponse = $this->actingAs($this->user)
            ->get('/api/users/' . $this->user->id . '/posts');
        $this->assertEquals(200, $getPostsResponse->getStatusCode());
        $json = json_decode($getPostsResponse->getContent());
        $this->assertEquals(1, count($json));
        $this->assertEquals('A new title', $json[0]->title);
    }
    
    public function testUserCannotUpdateOthersPost() {
        $role = Role::where('name', 'editor')->first();
        $otherUser = $user = factory(User::class)->create([
            'role_id' => $role->id
        ]);
        $post = factory(Post::class)->create([
            'user_id' => $otherUser
        ]);
    
        $updateResponse = $this->actingAs($this->user)
            ->put('/api/posts/' . $post->id, [
                'title' => 'A new title'
            ]);
        
        $this->assertEquals(403, $updateResponse->getStatusCode());
    }
}
