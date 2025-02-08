<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        // Eager-load the warehouse for each product
        $products = Product::with('warehouse')->orderBy('name')->get();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        // Retrieve all warehouses to populate the dropdown list
        $warehouses = Warehouse::orderBy('name')->get();

        return view('products.create', compact('warehouses'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'name'         => 'required|string|unique:products,name',
            'description'  => 'nullable|string',
            'price'        => 'required|numeric|min:0',
            'quantity'     => 'required|integer|min:0',
            'warehouse_id' => 'required|exists:warehouses,id',
        ]);

        // Create the product record
        Product::create($validatedData);

        // Redirect to the products index with a flash message
        return redirect()->route('products.index')
                         ->with('success', 'Product created successfully.');
    }
    



    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        // Retrieve all warehouses to populate the dropdown list
        $warehouses = Warehouse::orderBy('name')->get();

        return view('products.edit', compact('product', 'warehouses'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Validate the updated data
        $validatedData = $request->validate([
            'name'         => 'required',
            'description'  => 'nullable|string',
            'price'        => 'required|numeric|min:0',
            'quantity'     => 'required|integer|min:0',
            'warehouse_id' => 'required|exists:warehouses,id',
        ]);

        // Update the product record
        $product->update($validatedData);

        // Redirect with a success message
        return redirect()->route('products.index')
                         ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        // Delete the product record
        $product->delete();

        // Redirect back with a flash message
        return redirect()->route('products.index')
                         ->with('success', 'Product deleted successfully.');
    }
}
