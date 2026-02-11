@extends('layouts.app')

@section('content')
<div class="relative min-h-screen">
    <div class="max-w-7xl mx-auto px-6 py-16">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-neutral-100 rounded-full text-xs font-bold uppercase tracking-wider text-neutral-600 mb-3">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span> AI Generated
                </div>
                <h1 class="text-4xl font-bold text-neutral-900 capitalize leading-tight">
                    {{ str_replace('_', ' ', $activity ?? 'Outfit of the Day') }}
                </h1>
                <p class="text-neutral-500 mt-2 text-lg">{{ $fullDate ?? now()->format('l, d F Y') }}</p>
            </div>

            {{-- ACTION BUTTONS --}}
            <div class="flex gap-3">
                {{-- Tombol Try Another --}}
                <a href="{{ route('find-outfit.index') }}" class="px-6 py-3 bg-white border border-neutral-200 text-neutral-900 font-medium rounded-xl hover:bg-neutral-50 transition shadow-sm hover:shadow-md">
                    Try Another
                </a>

                {{-- Tombol Regenerate (Form) --}}
                <form action="{{ route('find-outfit.generate') }}" method="POST" id="regenerateForm">
                    @csrf
                    {{-- Kirim konteks activity agar AI tau apa yang harus di-regenerate --}}
                    <input type="hidden" name="activity" value="{{ $activity ?? 'custom' }}">
                    
                    <button type="submit" class="px-6 py-3 bg-neutral-900 text-white font-medium rounded-xl hover:bg-black transition shadow-lg hover:shadow-xl hover:-translate-y-0.5 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        Regenerate
                    </button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 md:gap-12">
            
            {{-- LEFT COLUMN: ITEMS --}}
            <div class="lg:col-span-2">
                <h3 class="text-lg font-bold text-neutral-900 mb-6 flex items-center gap-2">
                    Selected Items 
                    <span class="text-neutral-400 text-sm font-normal">({{ count($outfits) }} items)</span>
                </h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @foreach($outfits as $outfit)
                    <div class="group bg-white rounded-2xl border border-neutral-100 overflow-hidden hover:shadow-xl transition-all duration-500 relative">
                        {{-- Image Container --}}
                        <div class="relative aspect-[4/5] bg-neutral-50 overflow-hidden">
                            <img src="{{ asset('storage/'.$outfit->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            
                            {{-- Category Badge --}}
                            <div class="absolute top-4 left-4 z-10">
                                <span class="px-3 py-1.5 bg-white/90 backdrop-blur-md rounded-lg text-xs font-bold text-neutral-900 shadow-sm border border-white/20">
                                    {{ $outfit->category->name }}
                                </span>
                            </div>

                            {{-- Gradient Overlay (Optional visual enhancement) --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>

                        {{-- Item Details --}}
                        <div class="p-5">
                            <h4 class="font-semibold text-neutral-900 text-lg leading-tight">{{ $outfit->name }}</h4>
                            <p class="text-neutral-500 text-sm mt-1 truncate">ID: #{{ $outfit->id }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- RIGHT COLUMN: REASONING (Sticky) --}}
            <div class="lg:col-span-1">
                <div class="sticky top-8">
                    <div class="bg-neutral-900 text-white rounded-3xl p-8 shadow-2xl relative overflow-hidden ring-1 ring-white/10">
                        {{-- Background Decor --}}
                        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-neutral-700 rounded-full blur-3xl opacity-30 animate-pulse"></div>
                        <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-24 h-24 bg-green-500 rounded-full blur-3xl opacity-20"></div>
                        
                        <div class="relative z-10">
                            {{-- Header Insight --}}
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center backdrop-blur-sm border border-white/10">
                                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold">AI Insight</h3>
                                    <p class="text-neutral-400 text-xs uppercase tracking-wider">Styling Assistant</p>
                                </div>
                            </div>

                            {{-- Content Insight --}}
                            <div class="prose prose-invert prose-p:text-neutral-300 prose-p:leading-relaxed prose-sm">
                                @if(isset($ai_reasoning))
                                    <p>{{ $ai_reasoning }}</p>
                                @else
                                    <div class="flex flex-col gap-2">
                                        <div class="h-4 bg-white/10 rounded animate-pulse w-full"></div>
                                        <div class="h-4 bg-white/10 rounded animate-pulse w-5/6"></div>
                                        <div class="h-4 bg-white/10 rounded animate-pulse w-4/6"></div>
                                    </div>
                                @endif
                            </div>

                            {{-- Score --}}
                            <div class="mt-8 pt-6 border-t border-white/10">
                                <div class="flex justify-between items-end">
                                    <div>
                                        <p class="text-xs text-neutral-500 font-bold uppercase tracking-widest mb-2">Style Match Score</p>
                                        <div class="flex items-center gap-1">
                                            @for($i=0; $i<5; $i++)
                                                <svg class="w-5 h-5 text-yellow-400 drop-shadow-[0_0_8px_rgba(250,204,21,0.5)]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                            @endfor
                                        </div>
                                    </div>
                                    <span class="text-3xl font-black text-white/20">98%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- LOADING OVERLAY (REGENERATE VERSION) --}}
<div id="loadingOverlay" class="hidden fixed inset-0 z-[100] bg-white/95 backdrop-blur-md flex flex-col items-center justify-center transition-all duration-300">
    <div class="relative w-24 h-24 mb-6">
        {{-- Circle Background --}}
        <div class="absolute inset-0 bg-neutral-100 rounded-full animate-ping opacity-75"></div>
        <div class="relative bg-white border-2 border-neutral-100 w-full h-full rounded-full flex items-center justify-center shadow-xl">
            {{-- Emojis yang gonta ganti --}}
            <span id="shufflingEmoji" class="text-5xl animate-bounce">🤔</span>
        </div>
    </div>
    
    <h3 class="text-2xl font-bold text-neutral-900 mb-2">Remixing Your Look...</h3>
    <p class="text-neutral-500 animate-pulse">AI is curating a fresh combination for you</p>
    
    {{-- Progress Bar --}}
    <div class="w-64 h-2 bg-neutral-100 rounded-full mt-6 overflow-hidden">
        <div class="h-full bg-neutral-900 animate-[width_2s_ease-in-out_infinite]" style="width: 30%"></div>
    </div>
</div>

{{-- SCRIPT & STYLE --}}
<script>
    document.getElementById('regenerateForm').addEventListener('submit', function(e) {
        // Jangan preventDefault() karena kita mau form-nya submit beneran
        // Kita cuma mau nampilin overlay sebelum page reload
        
        const overlay = document.getElementById('loadingOverlay');
        const emojiEl = document.getElementById('shufflingEmoji');
        
        // Tampilkan overlay
        overlay.classList.remove('hidden');

        // Array icon (Campuran ekspresi mikir + baju)
        const remixEmojis = ['🤔', '👕', '💭', '👟', '👖', '✨', '🧥', '👔'];
        let index = 0;

        // Efek slot machine cepet
        setInterval(() => {
            emojiEl.innerText = remixEmojis[index];
            index = (index + 1) % remixEmojis.length;
        }, 120);
    });
</script>

<style>
    @keyframes width {
        0% { width: 0%; transform: translateX(-100%); }
        50% { width: 70%; transform: translateX(0%); }
        100% { width: 100%; transform: translateX(100%); }
    }
</style>
@endsection