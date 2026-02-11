@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20">
        
        {{-- LEFT COLUMN: VISUALS --}}
        <div class="space-y-8">
            {{-- Main Image --}}
            <div class="rounded-3xl overflow-hidden shadow-2xl bg-neutral-100 relative group">
                 <img src="{{ asset('storage/'.$trend->cover_image) }}" class="w-full object-cover transition duration-700 group-hover:scale-105">
                 <a href="{{ route('find-outfit.trend') }}" class="absolute top-6 left-6 w-10 h-10 bg-white/20 backdrop-blur rounded-full flex items-center justify-center text-white hover:bg-white/40 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                 </a>
            </div>

            {{-- TikTok References --}}
            @if($trend->tiktoks->isNotEmpty())
            <div>
                <h3 class="font-bold text-neutral-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z"/></svg>
                    Reference Videos
                </h3>
                <div class="space-y-3">
                    @foreach($trend->tiktoks as $tiktok)
                    <a href="{{ $tiktok->tiktok_url }}" target="_blank" class="flex items-center gap-4 p-4 bg-white border border-neutral-200 rounded-xl hover:border-neutral-900 transition group hover:shadow-lg hover:-translate-y-0.5 transform duration-200">
                        <div class="w-10 h-10 rounded-full bg-black flex items-center justify-center flex-shrink-0 text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-neutral-900 truncate group-hover:underline">{{ $tiktok->caption ?? 'Watch Video' }}</p>
                            <p class="text-xs text-neutral-500">@{{ $tiktok->creator_name ?? 'unknown' }}</p>
                        </div>
                        <svg class="w-4 h-4 text-neutral-400 group-hover:text-neutral-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        {{-- RIGHT COLUMN: INFO & ACTIONS --}}
        <div class="flex flex-col justify-center">
            
            <div class="mb-4">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-50 text-red-600 font-bold tracking-wider text-xs uppercase border border-red-100">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                    </span>
                    Currently Trending
                </span>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-bold text-neutral-900 mb-6 leading-tight tracking-tight">{{ $trend->title }}</h1>
            <p class="text-lg text-neutral-500 mb-10 leading-relaxed border-l-4 border-neutral-900 pl-6 bg-neutral-50 py-4 rounded-r-xl">
                {{ $trend->description }}
            </p>

            {{-- AI Insights Accordion/Box --}}
            <div class="space-y-6 mb-10">
                @if(isset($ai_insights))
                <div class="bg-white rounded-2xl p-6 border border-neutral-200 shadow-sm hover:shadow-md transition">
                    <h3 class="font-bold text-neutral-900 mb-3 flex items-center gap-2">
                        <div class="p-1.5 bg-blue-100 text-blue-600 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        Why it works
                    </h3>
                    <p class="text-neutral-600 text-sm leading-relaxed">{{ $ai_insights }}</p>
                </div>
                @endif

                @if(isset($styling_tips))
                <div class="bg-white rounded-2xl p-6 border border-neutral-200 shadow-sm hover:shadow-md transition">
                    <h3 class="font-bold text-neutral-900 mb-3 flex items-center gap-2">
                        <div class="p-1.5 bg-purple-100 text-purple-600 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                        </div>
                        Styling Tips
                    </h3>
                    <p class="text-neutral-600 text-sm leading-relaxed">{{ $styling_tips }}</p>
                </div>
                @endif
            </div>

            {{-- Primary Action --}}
            {{-- Tambahkan ID recreateForm --}}
            <form action="{{ route('find-outfit.trend.generate', $trend) }}" method="POST" id="recreateForm">
                @csrf
                <button type="submit" 
                        class="w-full group relative bg-neutral-900 text-white font-bold text-lg py-5 rounded-2xl hover:bg-black transition-all shadow-xl hover:shadow-2xl hover:-translate-y-1 flex items-center justify-center gap-3 overflow-hidden">
                    <span class="relative z-10 flex items-center gap-3">
                        Recreate with My Closet
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </span>
                    {{-- Shine Effect --}}
                    <div class="absolute top-0 -inset-full h-full w-1/2 z-5 block transform -skew-x-12 bg-gradient-to-r from-transparent to-white opacity-20 group-hover:animate-shine" />
                </button>
            </form>
            <p class="text-center text-xs text-neutral-400 mt-4">AI akan mencocokkan outfit di lemarimu dengan style ini.</p>

        </div>
    </div>
</div>

{{-- LOADING OVERLAY (RECREATE/MATCHING) --}}
<div id="loadingOverlay" class="hidden fixed inset-0 z-[60] bg-white/95 backdrop-blur-md flex flex-col items-center justify-center">
    <div class="relative w-24 h-24 mb-6">
        {{-- Animated Circle --}}
        <div class="absolute inset-0 bg-neutral-100 rounded-full animate-ping opacity-75"></div>
        <div class="relative bg-white border-2 border-neutral-100 w-full h-full rounded-full flex items-center justify-center shadow-xl">
            {{-- Emojis yang gonta ganti --}}
            <span id="shufflingEmoji" class="text-5xl animate-bounce">🔥</span>
        </div>
    </div>
    
    <h3 class="text-2xl font-bold text-neutral-900 mb-2">Matching Vibe...</h3>
    <p class="text-neutral-500 animate-pulse">Scanning your wardrobe for "{{ $trend->title }}"</p>
    
    {{-- Progress Bar --}}
    <div class="w-64 h-2 bg-neutral-100 rounded-full mt-6 overflow-hidden">
        <div class="h-full bg-neutral-900 animate-[width_2s_ease-in-out_infinite]" style="width: 30%"></div>
    </div>
</div>

<script>
    document.getElementById('recreateForm').addEventListener('submit', function(e) {
        const overlay = document.getElementById('loadingOverlay');
        const emojiEl = document.getElementById('shufflingEmoji');
        
        // Show overlay
        overlay.classList.remove('hidden');

        // Emoji list spesial buat trend: ada api, kacamata, bintang, dll
        const trendEmojis = ['🔥', '✨', '🕶️', '👖', '👟', '🧥', '📸', '💃'];
        let index = 0;

        // Efek slot machine
        setInterval(() => {
            emojiEl.innerText = trendEmojis[index];
            index = (index + 1) % trendEmojis.length;
        }, 120);
    });
</script>

<style>
    @keyframes width {
        0% { width: 0%; transform: translateX(-100%); }
        50% { width: 70%; transform: translateX(0%); }
        100% { width: 100%; transform: translateX(100%); }
    }
    
    @keyframes shine {
        100% { left: 125%; }
    }
    .animate-shine {
        animation: shine 1s;
    }
</style>
@endsection