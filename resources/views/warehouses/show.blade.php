@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold">{{ $warehouse->name }}</h1>
    <p>{{ $warehouse->description }}</p>
    <p>
        <strong>Coordinates:</strong> {{ $warehouse->latitude }}, {{ $warehouse->longitude }}
    </p>

    @if ($weather)
        <div class="mt-4 p-4 bg-blue-100 rounded">
            <h2 class="text-xl font-semibold">Current Weather</h2>
            <p><i class="fas fa-thermometer-half"></i> Temperature: {{ $weather['main']['temp'] }} °C </p>
            <p><i class="fas fa-cloud-sun"></i> Condition: {{ $weather['weather'][0]['description'] }}</p>
            <p><i class="fas fa-wind"></i> Wind Speed: {{ $weather['wind']['speed'] }} m/s</p>
            <p><i class="fas fa-map-marker-alt"></i> Location: {{ $weather['name'] }}</p>
        </div>
    @else
        <p class="mt-4 text-red-500">Unable to fetch weather data.</p>
    @endif

    <h2 class="mt-6 text-xl">Products in this Warehouse</h2>
    <!-- Display list of products and the total value calculation -->
    @if($warehouse->products->count())
        <ul>
            @foreach ($warehouse->products as $product)
                <li>
                    {{ $product->name }} - Price: {{ $product->price }} | Quantity: {{ $product->quantity }}
                </li>
            @endforeach
        </ul>
        @php
            $totalValue = $warehouse->products->reduce(function ($carry, $product) {
                return $carry + ($product->price * $product->quantity);
            }, 0);
        @endphp
        <p class="mt-2 font-semibold">Total Value: ${{ $totalValue }}</p>
    @else
        <p>No products available in this warehouse.</p>
    @endif

    <a href="{{ route('warehouses.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Back to Warehouses</a>
@endsection
