@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Product Details</h1>

    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
        <p class="mt-2"><strong>Description:</strong> {{ $product->description }}</p>
        <p class="mt-2"><strong>Price:</strong> ${{ $product->price }}</p>
        <p class="mt-2"><strong>Quantity:</strong> {{ $product->quantity }}</p>
        <p class="mt-2"><strong>Warehouse:</strong> {{ $product->warehouse->name }}</p>
    </div>

    <a href="{{ route('products.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Back to Products</a>
@endsection