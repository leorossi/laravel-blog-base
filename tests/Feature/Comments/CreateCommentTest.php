<?php

namespace Tests\Feature\Comments;
use App\Post;
use App\Role;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateCommentTest extends TestCase
{
    use RefreshDatabase;
    
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
    
    public function testUserCanCreateComment() {
    
        $role = Role::where('name', 'reader')->first();
        $reader = factory(User::class)->create([
            'role_id' => $role->id
        ]);
        $response = $this->actingAs($reader)->post('/api/posts/' . $this->post->id . '/comments', [
            'body' => 'this is a sample body for the comment'
        ]);
        
        $this->assertEquals(200, $response->status());
        
        $response = $this->actingAs($reader)->get('/api/posts/' . $this->post->id . '/comments');
        $this->assertEquals(200, $response->status());
        $json = json_decode($response->getContent());
        
        $this->assertEquals(1, count($json));
        $this->assertEquals('this is a sample body for the comment', $json[0]->body);
    }
    
    public function testUserCannotCreateCommentOnDraftPost() {
        
        $role = Role::where('name', 'reader')->first();
        
        $this->post->state = 'draft';
        $this->post->save();
        
        $reader = factory(User::class)->create([
            'role_id' => $role->id
        ]);
        $response = $this->actingAs($reader)->post('/api/posts/' . $this->post->id . '/comments', [
            'body' => 'this is a sample body for the comment'
        ]);
        
        $this->assertEquals(403, $response->status());
        
        $response = $this->actingAs($reader)->get('/api/posts/' . $this->post->id . '/comments');
        $this->assertEquals(200, $response->status());
        $json = json_decode($response->getContent());
        
        $this->assertEquals(0, count($json));
    }
}
