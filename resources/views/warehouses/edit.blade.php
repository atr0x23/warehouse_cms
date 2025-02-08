@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Warehouse</h1>

    <form action="{{ route('warehouses.update', $warehouse) }}" method="POST" class="max-w-lg">
        @csrf
        @method('PUT')  {{-- Spoof the PUT method for updating --}}
        
        <div class="mb-4">
            <label for="name" class="block font-semibold">Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $warehouse->name) }}" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block font-semibold">Description:</label>
            <textarea name="description" id="description" class="w-full border rounded p-2">{{ old('description', $warehouse->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="latitude" class="block font-semibold">Latitude:</label>
            <input type="text" name="latitude" id="latitude" value="{{ old('latitude', $warehouse->latitude) }}" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label for="longitude" class="block font-semibold">Longitude:</label>
            <input type="text" name="longitude" id="longitude" value="{{ old('longitude', $warehouse->longitude) }}" class="w-full border rounded p-2" required>
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Update Warehouse</button>
    </form>
@endsection