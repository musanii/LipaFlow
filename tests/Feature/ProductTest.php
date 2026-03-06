<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_create_product(): void
    {
         $user = User::factory()->create();

    $token = auth('api')->login($user);

    $response = $this->withHeader(
        'Authorization',
        "Bearer $token"
    )->postJson('/api/products',[
        'name'=>'Tusker',
        'price'=>300
    ]);

    $response->assertStatus(200);
      
    }
}
