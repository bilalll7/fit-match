<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin FitMatch</title>
    @vite('resources/css/app.css')

</head>

<body class="bg-gradient-to-br from-emerald-50 via-sky-50 to-blue-50">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-gradient-to-b from-emerald-500 via-green-500 to-teal-500 text-white p-6 shadow-xl">
        <div class="mb-10">
            <h2 class="text-2xl font-bold tracking-wide">FitMatch</h2>
            <p class="text-sm opacity-80">Admin Panel</p>
        </div>

        <nav class="space-y-3 text-sm">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/20 transition">
                📊 <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.styles.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/20 transition">
                👕 <span>Eksplorasi Gaya</span>
            </a>

            <a href="{{ route('admin.categories.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/20 transition">
                🗂 <span>Categories</span>
            </a>

            <a href="{{ route('admin.trends.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/20 transition">
                🔥 <span>Trend</span>
            </a>
        </nav>
    </aside>

    {{-- CONTENT --}}
    <main class="flex-1 p-10">
        <div class="bg-white/80 backdrop-blur rounded-3xl p-8 shadow-xl">
            @yield('content')
        </div>
    </main>

</div>

</body>
</html>