<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // GET /api/products
    public function index()
    {
        return response()->json(Product::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    // POST /api/products
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required',
            'price'        => 'required|numeric',
            'quantity'     => 'required|integer',
            'warehouse_id' => 'required|exists:warehouses,id',
            'description'  => 'nullable',
        ]);

        $product = Product::create($validated);
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    // GET /api/products/{id}
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    // PUT/PATCH /api/products/{id}
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name'         => 'sometimes|required',
            'price'        => 'sometimes|required|numeric',
            'quantity'     => 'sometimes|required|integer',
            'warehouse_id' => 'sometimes|required|exists:warehouses,id',
            'description'  => 'nullable',
        ]);

        $product->update($validated);
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    // DELETE /api/products/{id}
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(null, 204);
    }
}
