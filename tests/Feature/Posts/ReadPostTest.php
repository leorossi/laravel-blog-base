<?php

namespace Tests\Feature;

use App\Post;
use App\Role;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadPostTest extends TestCase
{
    use RefreshDatabase;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed([\RolesTableSeeder::class]);
        $editorRole = Role::where('name', 'editor')->first();
        $users = factory(User::class, 10)->create([
            'role_id' => $editorRole->id
        ]);
        foreach ($users as $user) {
            factory(Post::class, 10)->create([
                'user_id' => $user->id
            ]);
        }
    }
    
    public function testAllusersCanGetPostList() {
        
        $getResponse = $this->get('/api/posts');
        $this->assertEquals(200, $getResponse->getStatusCode());
        $json = json_decode($getResponse->getContent());
        $this->assertEquals(100, count($json));
    }
    
    
}
