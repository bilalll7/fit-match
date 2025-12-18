<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin FitMatch</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-white border-r p-6">
        <h2 class="font-bold text-xl mb-8">Admin Panel</h2>

        <nav class="space-y-4 text-sm">
            <a href="{{ route('admin.dashboard') }}" class="block hover:text-green-600">
                Dashboard
            </a>
            <a href="{{ route('admin.styles.index') }}" class="block hover:text-green-600">
                Eksplorasi Gaya
            </a>
            <a href="{{ route('admin.categories.index') }}" class="block hover:text-green-600">
                Categories
            </a>
            <a href="{{ route('admin.trends.index') }}" class="block hover:text-green-600">
                Trend
            </a>
        </nav>
    </aside>

    {{-- CONTENT --}}
    <main class="flex-1 p-8">
        @yield('content')
    </main>

</div>

</body>
</html>
