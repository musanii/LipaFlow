<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
        use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_user_can_login(): void
    {
    

        $user = User::factory()->create([
            'password'=>bcrypt('password')

        ]);

        $response = $this->postJson('api/auth/login',[
            'email'=>$user->email,
            'password'=>'password'
        ]);

        $response ->assertStatus(200)
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_in',
                'user'
            ]);
    }
}
