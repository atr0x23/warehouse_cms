<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warehouse CMS</title>
    @vite('resources/css/app.css') {{-- Assuming Tailwind is set up via Vite --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>
<body class="bg-gray-100 text-gray-900">
    <nav class="bg-white shadow p-4 mb-8">
        <a href="{{ route('dashboard') }}" class="mr-4">Dashboard</a>
        <a href="{{ route('warehouses.index') }}" class="mr-4">Warehouses</a>
        <a href="{{ route('products.index') }}" class="mr-4">Products</a>
    </nav>

    <div class="container mx-auto px-4">
        @yield('content')
    </div>

    @yield('scripts')
</body>
</html>
