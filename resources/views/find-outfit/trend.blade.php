@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12 min-h-screen">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-12">
        <div class="flex items-center gap-4">
            <a href="{{ route('find-outfit.index') }}" class="w-10 h-10 rounded-full bg-white border border-neutral-200 flex items-center justify-center text-neutral-500 hover:text-neutral-900 hover:border-neutral-900 transition shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-3xl font-bold text-neutral-900">Trending Now</h1>
        </div>
        
        <div class="mt-4 md:mt-0 px-4 py-2 bg-neutral-100 rounded-full text-sm font-medium text-neutral-600 border border-neutral-200">
            Updated Daily based on TikTok Trends
        </div>
    </div>

    @if($trends->isEmpty())
        <div class="text-center py-24 bg-neutral-50 rounded-3xl border border-dashed border-neutral-200">
            <p class="text-neutral-500">Belum ada trend outfit saat ini.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($trends as $trend)
            {{-- Tambahkan class 'trend-card' untuk selector JS --}}
            <a href="{{ route('find-outfit.trend.show', $trend) }}" class="trend-card group block">
                <div class="relative overflow-hidden rounded-2xl bg-neutral-100 aspect-[4/3] mb-4 shadow-sm group-hover:shadow-md transition-all">
                    <img src="{{ asset('storage/'.$trend->cover_image) }}" 
                         alt="{{ $trend->title }}" 
                         class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition"></div>
                    
                    <div class="absolute top-4 right-4">
                        <span class="bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-neutral-900 flex items-center gap-1 shadow-sm">
                            🔥 Trending
                        </span>
                    </div>
                </div>

                <h3 class="text-xl font-bold text-neutral-900 group-hover:text-neutral-600 transition">{{ $trend->title }}</h3>
                <p class="text-neutral-500 mt-2 line-clamp-2 text-sm">{{ $trend->description }}</p>
                
                <div class="flex items-center gap-2 mt-4 text-xs font-medium text-neutral-400 uppercase tracking-wider">
                    <span>{{ $trend->tiktoks->count() }} Videos</span>
                    <span>•</span>
                    <span>AI Analysis Available</span>
                </div>
            </a>
            @endforeach
        </div>
    @endif
</div>

{{-- LOADING OVERLAY (FETCHING TREND) --}}
<div id="loadingOverlay" class="hidden fixed inset-0 z-[60] bg-white/95 backdrop-blur-md flex flex-col items-center justify-center">
    <div class="relative w-20 h-20 mb-6">
        <div class="absolute inset-0 bg-blue-100 rounded-full animate-ping opacity-75"></div>
        <div class="relative bg-white border-2 border-blue-50 w-full h-full rounded-full flex items-center justify-center shadow-xl">
            <span class="text-4xl animate-pulse">📈</span>
        </div>
    </div>
    <h3 class="text-xl font-bold text-neutral-900 mb-2">Analyzing Trend...</h3>
    <p class="text-neutral-500 text-sm">Gathering styling insights for you</p>
</div>

<script>
    // Tangkap semua klik pada kartu trend
    document.querySelectorAll('.trend-card').forEach(card => {
        card.addEventListener('click', function(e) {
            // Tampilkan overlay loading sebelum pindah halaman
            document.getElementById('loadingOverlay').classList.remove('hidden');
        });
    });
</script>
@endsection