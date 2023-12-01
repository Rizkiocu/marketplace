<?php

namespace Tests\Feature;

use App\Models\product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_product()
    {
        $data = [
            'name' => 'Test Product',
            'price' => 29.99,
            'description' => 'This is a test product.',
        ];

        $response = $this->postJson('/api/products', $data);

        $response->assertStatus(201)
                 ->assertJson([
                     'status' => true,
                     'message' => 'Product created successfully',
                     'data' => $data,
                 ]);

        $this->assertDatabaseHas('products', $data);
    }

    /** @test */
    public function it_can_show_product_details()
    {
        $product = Product::factory()->create();

        $response = $this->getJson("/api/products/{$product->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                     'message' => 'Product details',
                     'data' => [
                         'id' => $product->id,
                         'name' => $product->name,
                         'price' => $product->price,
                         'description' => $product->description,
                     ],
                 ]);
    }

    /** @test */
    public function it_can_update_a_product()
    {
        $product = Product::factory()->create();

        $data = [
            'name' => 'Updated Product',
            'price' => 39.99,
            'description' => 'This is an updated product.',
        ];

        $response = $this->putJson("/api/products/{$product->id}", $data);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                     'message' => 'Product updated successfully',
                     'data' => $data,
                 ]);

        $this->assertDatabaseHas('products', $data);
    }

    /** @test */
    public function it_can_delete_a_product()
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson("/api/products/{$product->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                     'message' => 'Product deleted successfully',
                 ]);

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}