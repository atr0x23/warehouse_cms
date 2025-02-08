@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Create New Warehouse</h1>

    <form action="{{ route('warehouses.store') }}" method="POST" class="max-w-lg">
        @csrf
        <div class="mb-4">
            <label for="name" class="block font-semibold">Name:</label>
            <input type="text" name="name" id="name" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block font-semibold">Description:</label>
            <textarea name="description" id="description" class="w-full border rounded p-2"></textarea>
        </div>

        <div class="mb-4">
            <label for="latitude" class="block font-semibold">Latitude:</label>
            <input type="text" name="latitude" id="latitude" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label for="longitude" class="block font-semibold">Longitude:</label>
            <input type="text" name="longitude" id="longitude" class="w-full border rounded p-2" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create Warehouse</button>
    </form>
@endsection