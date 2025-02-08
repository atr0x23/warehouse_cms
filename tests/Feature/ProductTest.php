<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_the_product_index_page()
    {
        $warehouse = Warehouse::factory()->create();
        $product = Product::factory()->create(['warehouse_id' => $warehouse->id]);

        $response = $this->get(route('products.index'));
        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

    /** @test */
    public function it_creates_a_new_product()
    {
        $warehouse = Warehouse::factory()->create();

        $data = [
            'name' => 'Test Product',
            'description' => 'A description for the test product',
            'price' => 10.50,
            'quantity' => 5,
            'warehouse_id' => $warehouse->id,
        ];

        $response = $this->post(route('products.store'), $data);
        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseHas('products', ['name' => 'Test Product']);
    }

    /** @test */
    public function it_updates_an_existing_product()
    {
        $warehouse = Warehouse::factory()->create();
        $product = Product::factory()->create(['warehouse_id' => $warehouse->id]);

        $data = [
            'name' => 'Updated Product Name',
            'description' => $product->description,
            'price' => $product->price,
            'quantity' => $product->quantity,
            'warehouse_id' => $warehouse->id,
        ];

        $response = $this->put(route('products.update', $product), $data);
        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseHas('products', ['name' => 'Updated Product Name']);
    }

    /** @test */
    public function it_deletes_a_product()
    {
        $warehouse = Warehouse::factory()->create();
        $product = Product::factory()->create(['warehouse_id' => $warehouse->id]);

        $response = $this->delete(route('products.destroy', $product));
        $response->assertRedirect(route('products.index'));
        $this->assertDeleted($product);
    }
}