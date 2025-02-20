<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Services\WeatherService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Retrieve all warehouses along with the count of related products
        $warehouses = Warehouse::withCount('products')->orderBy('name')->get();

        // Return the warehouses.index view with the retrieved data
        return view('warehouses.index', compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('warehouses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'name'        => 'required|unique:warehouses,name',
                'description' => 'nullable|string', 
                'latitude'    => 'required|numeric|between:-90,90',
                'longitude'   => 'required|numeric|between:-180,180',
            ]);

            // Use a transaction for database operations
            DB::beginTransaction();

            // Create a new warehouse using the validated data
            \App\Models\Warehouse::create($validatedData);

            DB::commit();

            // Redirect to the warehouses index page with a success message
            return redirect()->route('warehouses.index')
                            ->with('success', 'Warehouse created successfully.');

        } catch (ValidationException $e) {
            // Handle validation errors
            return redirect()->back()
                            ->withErrors($e->errors())
                            ->withInput();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Warehouse creation failed: ' . $e->getMessage());

            return redirect()->back()
                            ->with('error', 'An unexpected error occurred while creating the warehouse.')
                            ->withInput();
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $warehouse = Warehouse::with('products')->findOrFail($id);

        // Fetch weather info based on warehouse coordinates
        $weatherService = new WeatherService();
        $weather = $weatherService->getWeather($warehouse->latitude, $warehouse->longitude);

        // echo "<pre>";
        // print_r($weather);
        // echo "</pre>";
        // exit;

        return view('warehouses.show', compact('warehouse', 'weather'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warehouse $warehouse)
    {
        // Return the edit view with the warehouse data for editing
        return view('warehouses.edit', compact('warehouse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        // Validate the request data.
        // For the name field, we use a unique rule that ignores the current warehouse record.
        $validatedData = $request->validate([
            'name' => 'required|unique:warehouses,name,' . $warehouse->id,
            'description' => 'nullable|string',
            // Ensure latitude is numeric and optionally within the range for valid coordinates
            'latitude' => 'required|numeric|between:-90,90',
            // Ensure longitude is numeric and optionally within the range for valid coordinates
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        // Update the warehouse with the validated data
        $warehouse->update($validatedData);

        // Redirect to the warehouses index page with a success message
        return redirect()->route('warehouses.index')
                        ->with('success', 'Warehouse updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warehouse $warehouse)
    {
        // Delete the warehouse record from the database.
        $warehouse->delete();
    
        // Optionally, if you have cascading deletion for related products (set in your migration or model),
        // they will be removed automatically. Otherwise, ensure you handle them accordingly.
    
        // Redirect back to the warehouses index page with a success message.
        return redirect()->route('warehouses.index')
                         ->with('success', 'Warehouse deleted successfully.');
    }
    
}
