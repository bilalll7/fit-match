<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - FitMatch</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-sans">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-white border-r p-6">
        <h2 class="text-xl font-bold mb-8">Admin Panel</h2>

        <nav class="space-y-4 text-sm">
            <a href="{{ route('admin.dashboard') }}"
               class="block text-gray-700 hover:text-green-600">
                Dashboard
            </a>

            <a href="{{ route('admin.styles.index') }}"
               class="block text-gray-700 hover:text-green-600">
                Eksplorasi Gaya
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
