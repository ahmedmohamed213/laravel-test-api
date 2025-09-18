<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function test_product(): void
    {
        $product = [
            'name' => 'product 1',
            'price' => 100,
            'stock' => 5,
        ];

        $response = $this->postJson('/api/products', $product);

        $response
            ->assertStatus(201)
            ->assertJsonFragment(['name' => 'product 1']);
    }
}
