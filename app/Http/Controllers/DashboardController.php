<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Warehouse;
use App\Services\WeatherService;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalWarehouses = Warehouse::count();
        $totalProducts   = Product::count();
        $totalValue      = Product::select(DB::raw('SUM(price * quantity) as total'))->first()->total;

        //fetch weather for all warehouses
        $weatherService = new WeatherService();
        $warehouses     = Warehouse::all();
        $weatherData    = [];
        foreach ($warehouses as $warehouse) { //multiple API calls
            $weatherData[$warehouse->id] = $weatherService->getWeather($warehouse->latitude, $warehouse->longitude); 
        }

        return view('dashboard.index', compact('totalWarehouses', 'totalProducts', 'totalValue', 'warehouses', 'weatherData'));
    }
}

