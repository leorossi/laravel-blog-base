<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterUserTest extends TestCase
{
    protected function setUp() : void
    {
        parent::setUp();
        $this->seed([\RolesTableSeeder::class]);
    }
    
    use RefreshDatabase;
    public function test_user_can_register_as_editor_with_email_and_password() {
        $response = $this->json('POST', 'api/register', [
            'name' => 'New User Name',
            'email' => 'test@asd.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'role' => 'editor',
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure(['id', 'name', 'email', 'api_token']);
        $this->assertEquals(60, strlen($response->json('api_token')));
    }
    public function test_user_can_register_as_reader_with_email_and_password() {
        $response = $this->json('POST', 'api/register', [
            'name' => 'New User Name',
            'email' => 'test@asd.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'role' => 'reader',
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure(['id', 'name', 'email', 'api_token']);
        $this->assertEquals(60, strlen($response->json('api_token')));
    }
    
    public function test_user_cannot_register_with_invalid_role() {
        $response = $this->json('POST', 'api/register', [
            'name' => 'New User Name',
            'email' => 'test@asd.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'role' => 'invalid_role',
        ]);
        $response->assertStatus(422);
        $this->assertArrayHasKey('errors', $response->json());
        $this->assertArrayHasKey('role', $response->json('errors'));
    }
    
    public function test_user_can_login_after_register() {
        // Register an user first
        $this->json('POST', 'api/register', [
            'name' => 'New User Name',
            'email' => 'test@asd.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'role' => 'editor',
        ]);
        
        // Login
        
        $response = $this->json('POST', 'api/login', [
            'email' => 'test@asd.com',
            'password' => 'secret123'
        ]);
    
        $response->assertStatus(200);
        $response->assertJsonStructure(['id', 'name', 'email', 'api_token']);
    }
    
    public function test_user_should_not_login_with_invalid_credentials() {
        // Register an user first
        $this->json('POST', 'api/register', [
            'name' => 'New User Name',
            'email' => 'test@asd.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'role' => 'editor',
        ]);
    
        // Login
    
        $response = $this->json('POST', 'api/login', [
            'email' => 'test@asd.com',
            'password' => 'wrongpassword'
        ]);
    
        $response->assertStatus(400);
        $this->assertEquals('Invalid credentials', $response->json('message'));
    }
}
