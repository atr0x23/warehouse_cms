@extends('layouts.app')

@section('content')

    @if(session('success'))
        <div id="flash-message" class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div id="flash-message" class="bg-red-500 text-white p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
    
    <h1 class="text-2xl font-bold mb-4">Products</h1>
    <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add New product</a>
    <table class="min-w-full mt-4">
        <thead>
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">description</th>
                <th class="border px-4 py-2">price (€)</th>
                <th class="border px-4 py-2">quantity</th>
                <th class="border px-4 py-2">warehouse id</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td class="border px-4 py-2">{{ $product->id }}</td>
                    <td class="border px-4 py-2">{{ $product->name }}</td>
                    <td class="border px-4 py-2">{{ $product->description }}</td>
                    <td class="border px-4 py-2">{{ $product->price }}</td>
                    <td class="border px-4 py-2">{{ $product->quantity }}</td>
                    <td class="border px-4 py-2">{{ $product->warehouse_id }}</td>
                    <td class="border px-4 py-2">
                        <div class="flex">
                            <a href="{{ route('products.show', $product) }}" class="text-blue-500 mr-2"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('products.edit', $product) }}" class="text-green-500 mr-2 ml-2"><i class="fas fa-edit"></i></a>
                            <!-- delete button form start here -->
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline" style="display:inline-block;"
                            onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 ml-2"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                setTimeout(() => {
                    flashMessage.style.display = 'none';
                }, 2500); //milliseconds
            }
        });
    </script>
@endsection
