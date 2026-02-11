<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin FitMatch</title>
    @vite('resources/css/app.css')
    
    {{-- FONT POPPINS --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    {{-- ALPINE JS --}}
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    {{-- SWEETALERT --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body { font-family: 'Poppins', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="bg-neutral-50 text-neutral-900 antialiased">

<div class="flex min-h-screen">

    {{-- SIDEBAR (HITAM PEKAT) --}}
    <aside class="w-72 bg-neutral-900 text-white flex flex-col shadow-2xl z-20">
        <div class="p-8 border-b border-neutral-800">
            <h2 class="text-3xl font-black tracking-tighter">FitMatch.</h2>
            <p class="text-xs text-neutral-500 uppercase tracking-widest mt-1">Admin Control</p>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2 text-sm font-medium">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-200
               {{ request()->routeIs('admin.dashboard') ? 'bg-white text-neutral-900 shadow-lg' : 'text-neutral-400 hover:bg-neutral-800 hover:text-white' }}">
               <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
               Dashboard
            </a>

            <a href="{{ route('admin.styles.index') }}"
               class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-200
               {{ request()->routeIs('admin.styles.*') ? 'bg-white text-neutral-900 shadow-lg' : 'text-neutral-400 hover:bg-neutral-800 hover:text-white' }}">
               <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" /></svg>
               Style Guide
            </a>

            <a href="{{ route('admin.categories.index') }}"
               class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-200
               {{ request()->routeIs('admin.categories.*') ? 'bg-white text-neutral-900 shadow-lg' : 'text-neutral-400 hover:bg-neutral-800 hover:text-white' }}">
               <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
               Categories
            </a>

            <a href="{{ route('admin.trends.index') }}"
               class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-200
               {{ request()->routeIs('admin.trends.*') ? 'bg-white text-neutral-900 shadow-lg' : 'text-neutral-400 hover:bg-neutral-800 hover:text-white' }}">
               <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
               Trend Radar
            </a>
        </nav>
        
        <div class="p-6 border-t border-neutral-800">
             <button class="flex items-center gap-3 text-neutral-400 hover:text-white transition w-full text-sm">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                Sign Out
            </button>
        </div>
    </aside>

    {{-- CONTENT AREA --}}
    <main class="flex-1 p-8 lg:p-12 overflow-y-auto">
        <div class="max-w-7xl mx-auto">
            @yield('content')
        </div>
    </main>

</div>

{{-- Global Success Toast --}}
@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: '#171717',
            color: '#fff',
            iconColor: '#fff',
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        Toast.fire({ icon: 'success', title: '{{ session('success') }}' });
    });
</script>
@endif

</body>
</html>