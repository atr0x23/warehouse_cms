@extends('layouts.app')

@section('content')

    <h1 class="text-2xl font-bold mb-4">Create New Product</h1>


    <form action="{{ route('products.store') }}" method="POST" class="max-w-lg">
        @csrf

        <div class="mb-4">
            <label for="name" class="block font-semibold">Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block font-semibold">Description:</label>
            <textarea name="description" id="description" class="w-full border rounded p-2">{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="price" class="block font-semibold">Price:</label>
            <input type="number" name="price" id="price" step="0.01" value="{{ old('price') }}" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label for="quantity" class="block font-semibold">Quantity:</label>
            <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label for="warehouse_id" class="block font-semibold">Warehouse:</label>
            <select name="warehouse_id" id="warehouse_id" class="w-full border rounded p-2" required>
                <option value="">Select a Warehouse</option>
                @foreach ($warehouses as $warehouse)
                    <option value="{{ $warehouse->id }}" {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                        {{ $warehouse->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create Product</button>
    </form>
@endsection
