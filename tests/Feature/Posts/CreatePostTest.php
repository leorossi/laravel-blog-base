<?php

namespace Tests\Feature;

use App\Role;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatePostTest extends TestCase
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
    }
    
    public function testUserCanCreatePost() {
        
        $user = $this->user;
        $response = $this->actingAs($user)->post('/api/posts', [
            'title' => 'Sample title',
            'body' => 'this is a sample body'
        ]);
        
        $this->assertEquals(200, $response->status());
        
        $response = $this->actingAs($user)->get('/api/users/' . $user->id . '/posts');
        $this->assertEquals(200, $response->status());
        $json = json_decode($response->getContent());
        
        $this->assertEquals(1, count($json));
        $this->assertEquals('Sample title', $json[0]->title);
        $this->assertEquals('published', $json[0]->state);
    }
}
