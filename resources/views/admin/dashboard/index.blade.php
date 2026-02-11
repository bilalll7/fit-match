@extends('admin.layouts.app')

@section('content')

    {{-- CHART.JS CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- Header Section --}}
    <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-4xl font-black text-neutral-900 tracking-tight">Dashboard</h1>
            <p class="text-neutral-500 mt-2 font-medium">Overview statistik FitMatch hari ini.</p>
        </div>
        <div class="text-right hidden md:block">
            <p class="text-xs font-bold text-neutral-400 uppercase tracking-widest">Current Date</p>
            <p class="text-lg font-bold text-neutral-900">{{ now()->format('d M Y') }}</p>
        </div>
    </div>

    {{-- STATS GRID --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">

        {{-- Card 1: Total Styles --}}
        <div class="group bg-white p-8 rounded-3xl border border-neutral-100 shadow-[0_4px_20px_rgb(0,0,0,0.03)] hover:shadow-[0_4px_25px_rgb(0,0,0,0.06)] transition duration-300">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-neutral-900 rounded-2xl text-white">
                    {{-- Icon Baju --}}
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <span class="text-xs font-bold px-3 py-1 bg-neutral-100 rounded-full text-neutral-600">
                    +{{ $totalStyles > 0 ? '100%' : '0%' }}
                </span>
            </div>
            <p class="text-neutral-500 text-sm font-medium">Total Styles</p>
            <h3 class="text-5xl font-black text-neutral-900 mt-1 tracking-tight">{{ $totalStyles }}</h3>
        </div>

        {{-- Card 2: Total Categories/Outfits --}}
        <div class="group bg-white p-8 rounded-3xl border border-neutral-100 shadow-[0_4px_20px_rgb(0,0,0,0.03)] hover:shadow-[0_4px_25px_rgb(0,0,0,0.06)] transition duration-300">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-neutral-100 rounded-2xl text-neutral-900">
                    {{-- Icon Kategori --}}
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
            </div>
            <p class="text-neutral-500 text-sm font-medium">Total Categories</p>
            <h3 class="text-5xl font-black text-neutral-900 mt-1 tracking-tight">{{ $totalCategories }}</h3>
        </div>

        {{-- Card 3: Users --}}
        <div class="group bg-white p-8 rounded-3xl border border-neutral-100 shadow-[0_4px_20px_rgb(0,0,0,0.03)] hover:shadow-[0_4px_25px_rgb(0,0,0,0.06)] transition duration-300">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-neutral-100 rounded-2xl text-neutral-900">
                   {{-- Icon User --}}
                   <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>
            <p class="text-neutral-500 text-sm font-medium">Active Users</p>
            <h3 class="text-5xl font-black text-neutral-900 mt-1 tracking-tight">{{ $totalUsers }}</h3>
        </div>
    </div>

    {{-- CHARTS SECTION --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
        
        {{-- Chart 1: Bar Chart --}}
        <div class="bg-white p-8 rounded-3xl border border-neutral-100 shadow-[0_4px_20px_rgb(0,0,0,0.03)]">
            <h3 class="text-lg font-bold text-neutral-900 mb-6">Data Distribution</h3>
            <div class="relative h-64 w-full">
                <canvas id="barChart"></canvas>
            </div>
        </div>

        {{-- Chart 2: Doughnut Chart --}}
        <div class="bg-white p-8 rounded-3xl border border-neutral-100 shadow-[0_4px_20px_rgb(0,0,0,0.03)]">
            <h3 class="text-lg font-bold text-neutral-900 mb-6">Style Status</h3>
            <div class="relative h-64 w-full flex justify-center">
                <canvas id="doughnutChart"></canvas>
            </div>
        </div>

    </div>

    {{-- Welcome Banner Bawah --}}
    <div class="bg-neutral-900 rounded-3xl p-10 text-white shadow-2xl relative overflow-hidden">
        {{-- Dekorasi Circle --}}
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
        <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>

        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <h2 class="text-2xl font-bold mb-2">Welcome to FitMatch Admin</h2>
                <p class="text-neutral-400 max-w-xl text-sm leading-relaxed">
                    Kelola style, kategori, dan trend dengan mudah. 
                    Tampilan monokrom ini didesain untuk kenyamanan mata dan fokus pada data.
                </p>
            </div>
            <a href="{{ route('admin.styles.create') }}" class="bg-white text-black px-8 py-3 rounded-xl font-bold text-sm hover:bg-neutral-200 transition transform hover:scale-105 shadow-lg">
                + Add New Style
            </a>
        </div>
    </div>

    {{-- SCRIPT CHART JS CONFIG --}}
    <script>
        // Konfigurasi Font Global ChartJS agar sesuai tema (Poppins)
        Chart.defaults.font.family = "'Poppins', sans-serif";
        Chart.defaults.color = '#737373'; // Text color neutral-500
        Chart.defaults.scale.grid.color = '#f5f5f5'; // Grid color neutral-100

        // 1. DATA UNTUK BAR CHART
        const ctxBar = document.getElementById('barChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Styles', 'Categories', 'Users'],
                datasets: [{
                    label: 'Total Data',
                    data: [{{ $totalStyles }}, {{ $totalCategories }}, {{ $totalUsers }}],
                    backgroundColor: [
                        '#171717', // Style (Hitam)
                        '#737373', // Category (Abu Tua)
                        '#d4d4d4'  // User (Abu Muda)
                    ],
                    borderRadius: 8,
                    barThickness: 40
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false } // Hilangkan legend biar bersih
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        border: { display: false } // Hilangkan garis border axis
                    },
                    x: {
                        grid: { display: false }, // Hilangkan grid vertikal
                        border: { display: false }
                    }
                }
            }
        });

        // 2. DATA UNTUK DOUGHNUT CHART (Active vs Inactive)
        const ctxDoughnut = document.getElementById('doughnutChart').getContext('2d');
        new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                labels: ['Active', 'Inactive'],
                datasets: [{
                    data: [{{ $activeStyles }}, {{ $inactiveStyles }}],
                    backgroundColor: [
                        '#171717', // Active (Hitam)
                        '#e5e5e5'  // Inactive (Abu sangat muda)
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%', // Bikin bolongan tengah lebih besar (modern look)
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { usePointStyle: true, padding: 20 }
                    }
                }
            }
        });
    </script>

@endsection