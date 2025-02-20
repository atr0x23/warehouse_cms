<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Warehouse;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WarehouseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_the_warehouse_index_page()
    {
        $warehouse = Warehouse::factory()->create();

        $response = $this->get(route('warehouses.index'));
        $response->assertStatus(200);
        $response->assertSee($warehouse->name);
    }

    /** @test */
    public function it_creates_a_new_warehouse()
    {
        $data = [
            'name' => 'Test Warehouse',
            'description' => 'A test warehouse description.',
            'latitude' => 45.0,
            'longitude' => -90.0,
        ];

        $response = $this->post(route('warehouses.store'), $data);
        $response->assertRedirect(route('warehouses.index'));
        $this->assertDatabaseHas('warehouses', ['name' => 'Test Warehouse']);
    }

    /** @test */
    public function it_updates_an_existing_warehouse()
    {
        $warehouse = Warehouse::factory()->create();

        $data = [
            'name' => 'Updated Warehouse Name',
            'description' => $warehouse->description,
            'latitude' => $warehouse->latitude,
            'longitude' => $warehouse->longitude,
        ];

        $response = $this->put(route('warehouses.update', $warehouse), $data);
        $response->assertRedirect(route('warehouses.index'));
        $this->assertDatabaseHas('warehouses', ['name' => 'Updated Warehouse Name']);
    }

    /** @test */
    public function it_deletes_a_warehouse()
    {
        $warehouse = Warehouse::factory()->create();

        $response = $this->delete(route('warehouses.destroy', $warehouse));
        $response->assertRedirect(route('warehouses.index'));
        $this->assertDatabaseMissing('warehouses', ['id' => $warehouse->id]);
    }
}
