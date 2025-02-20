@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

    <div class="grid grid-cols-3 gap-4 mb-8">
        <div class="p-4 bg-white shadow rounded">
            <h2 class="font-semibold">Total Warehouses</h2>
            <p>{{ $totalWarehouses }}</p>
        </div>
        <div class="p-4 bg-white shadow rounded">
            <h2 class="font-semibold">Total Products</h2>
            <p>{{ $totalProducts }}</p>
        </div>
        <div class="p-4 bg-white shadow rounded">
            <h2 class="font-semibold">Total Value of Stock</h2>
            <p>€{{ number_format($totalValue, 2) }}</p>
        </div>
    </div>

    <h2 class="text-xl font-bold mb-4">Warehouse Weather</h2>
    <div class="grid grid-cols-2 gap-4">
        @foreach($warehouses as $warehouse)
            <div class="p-4 bg-white shadow rounded">
                <h3 class="font-semibold">{{ $warehouse->name }}</h3>
                @if(isset($weatherData[$warehouse->id]))
                    <p><i class="fas fa-thermometer-half"></i> Temp: {{ $weatherData[$warehouse->id]['main']['temp'] }} °C</p>
                    <p><i class="fas fa-cloud-sun"></i> Condition: {{ $weatherData[$warehouse->id]['weather'][0]['description'] }}</p>
                    <p><i class="fas fa-wind"></i> Wind: {{ $weatherData[$warehouse->id]['wind']['speed'] }} m/s</p>
                    <p><i class="fas fa-map-marker-alt"></i> Location: {{ $weatherData[$warehouse->id]['name'] }} | {{ $weatherData[$warehouse->id]['sys']['country'] }}</p>

                    @php
                        $warehouseProducts = $totalProductsPerWarehouse->filter(function($item) use ($warehouse) {
                            return $item->warehouse_id == $warehouse->id;
                        })->first();
                    @endphp
                    <p><i class="fas fa-archive"></i> Total products: {{ $warehouseProducts ? $warehouseProducts->total : 0 }}</p>
                @else
                    <p>Weather data unavailable.</p>
                @endif
            </div>
        @endforeach
    </div>
@endsection
