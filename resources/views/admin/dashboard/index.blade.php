@extends('admin.layouts.app')

@section('content')
    {{-- Header --}}
    <div class="mb-10">
        <h1 class="text-4xl font-bold bg-gradient-to-r from-emerald-500 to-sky-500 bg-clip-text text-transparent">
            Dashboard Admin
        </h1>
        <p class="text-gray-500 mt-2">
            Kelola dan pantau data FitMatch dengan mudah
        </p>
    </div>

    {{-- Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        {{-- Card Style --}}
        <div class="relative overflow-hidden rounded-3xl p-6 shadow-xl
                    bg-gradient-to-br from-emerald-400 via-green-400 to-teal-400 text-white">
            <div class="absolute -top-6 -right-6 w-24 h-24 bg-white/20 rounded-full"></div>

            <h3 class="text-sm opacity-90">Total Style</h3>
            <p class="text-4xl font-bold mt-2">10</p>
            <p class="text-xs opacity-80 mt-1">Data style terdaftar</p>

            <div class="absolute bottom-4 right-4 text-4xl opacity-80">
                👕
            </div>
        </div>

        {{-- Card Outfit --}}
        <div class="relative overflow-hidden rounded-3xl p-6 shadow-xl
                    bg-gradient-to-br from-sky-400 via-blue-400 to-indigo-400 text-white">
            <div class="absolute -top-6 -right-6 w-24 h-24 bg-white/20 rounded-full"></div>

            <h3 class="text-sm opacity-90">Total Outfit</h3>
            <p class="text-4xl font-bold mt-2">25</p>
            <p class="text-xs opacity-80 mt-1">Koleksi outfit</p>

            <div class="absolute bottom-4 right-4 text-4xl opacity-80">
                👖
            </div>
        </div>

        {{-- Card User --}}
        <div class="relative overflow-hidden rounded-3xl p-6 shadow-xl
                    bg-gradient-to-br from-lime-400 via-emerald-400 to-green-500 text-white">
            <div class="absolute -top-6 -right-6 w-24 h-24 bg-white/20 rounded-full"></div>

            <h3 class="text-sm opacity-90">Pengguna Aktif</h3>
            <p class="text-4xl font-bold mt-2">5</p>
            <p class="text-xs opacity-80 mt-1">User terdaftar</p>

            <div class="absolute bottom-4 right-4 text-4xl opacity-80">
                👤
            </div>
        </div>

    </div>

    {{-- Welcome Card --}}
    <div class="rounded-3xl p-8 shadow-xl
                bg-gradient-to-r from-emerald-50 via-sky-50 to-blue-50 border border-green-100">
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">
            Selamat datang di FitMatch ✨
        </h2>
        <p class="text-gray-600 max-w-2xl">
            Dashboard ini membantu admin mengelola style, outfit, dan pengguna
            dengan tampilan yang modern, ringan, dan nyaman dilihat.
        </p>
    </div>
@endsection