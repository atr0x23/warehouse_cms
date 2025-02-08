<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_fetch_all_products_via_api()
    {
        $warehouse = Warehouse::factory()->create();
        Product::factory()->count(3)->create(['warehouse_id' => $warehouse->id]);

        $response = $this->getJson('/api/products');
        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    /** @test */
    public function it_can_create_a_product_via_api()
    {
        $warehouse = Warehouse::factory()->create();

        $data = [
            'name' => 'API Product',
            'description' => 'Created via API',
            'price' => 15.99,
            'quantity' => 10,
            'warehouse_id' => $warehouse->id,
        ];

        $response = $this->postJson('/api/products', $data);
        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'API Product']);

        $this->assertDatabaseHas('products', ['name' => 'API Product']);
    }

    /** @test */
    public function it_can_update_a_product_via_api()
    {
        $warehouse = Warehouse::factory()->create();
        $product = Product::factory()->create(['warehouse_id' => $warehouse->id]);

        $data = [
            'name' => 'Updated API Product',
            'description' => 'Updated API description',
            'price' => 20.00,
            'quantity' => 25,
            'warehouse_id' => $warehouse->id,
        ];

        $response = $this->putJson('/api/products/' . $product->id, $data);
        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Updated API Product']);

        $this->assertDatabaseHas('products', ['name' => 'Updated API Product']);
    }

    /** @test */
    public function it_can_delete_a_product_via_api()
    {
        $warehouse = Warehouse::factory()->create();
        $product = Product::factory()->create(['warehouse_id' => $warehouse->id]);

        $response = $this->deleteJson('/api/products/' . $product->id);
        $response->assertStatus(204);
        $this->assertDeleted($product);
    }
}