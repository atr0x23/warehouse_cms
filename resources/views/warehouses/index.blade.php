@extends('layouts.app')

@section('content')

    @if(session('success'))
        <div id="flash-message" class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
            </div>
    @endif

    <h1 class="text-2xl font-bold mb-4">Warehouses</h1>
    <a href="{{ route('warehouses.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add New Warehouse</a>
    <table class="min-w-full mt-4">
        <thead>
            <tr>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Products Count</th>
                <th class="border px-4 py-2">Coordinates</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($warehouses as $warehouse)
                <tr>
                    <td class="border px-4 py-2">{{ $warehouse->name }}</td>
                    <td class="border px-4 py-2">{{ $warehouse->products_count }}</td>
                    <td class="border px-4 py-2">{{ $warehouse->latitude }}, {{ $warehouse->longitude }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('warehouses.show', $warehouse) }}" class="text-blue-500 mr-2"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('warehouses.edit', $warehouse) }}" class="text-green-500 mr-2 ml-2"><i class="fas fa-edit"></i></a>

                        <!-- Delete form with confirmation -->
                        <form action="{{ route('warehouses.destroy', $warehouse) }}" method="POST" style="display:inline-block;"
                            onsubmit="return confirm('Are you sure you want to delete this warehouse?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 ml-2"><i class="fas fa-trash"></i></button>
                        </form>
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
                }, 2500); // 3000 milliseconds = 3 seconds
            }
        });
    </script>
@endsection
