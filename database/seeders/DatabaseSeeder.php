<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // public function run(): void
    // {
    //     // User::factory(10)->create();

    //     User::factory()->create([
    //         'name' => 'Test User',
    //         'email' => 'test@example.com',
    //     ]);
    // }

    public function run()
    {
        // This will create 5 warehouses, each with 10 related products.
        \App\Models\Warehouse::factory(5)
            ->has(\App\Models\Product::factory()->count(10), 'products')
            ->create();
    }

}

