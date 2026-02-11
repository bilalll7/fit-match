@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-16 min-h-screen flex flex-col items-center justify-center">

    <div class="text-center mb-16 max-w-2xl">
        <h1 class="text-5xl font-bold tracking-tight text-neutral-900 mb-6">
            Styling Assistant
        </h1>
        <p class="text-lg text-neutral-500 leading-relaxed">
            Bingung mau pakai apa? Biarkan AI menganalisa koleksimu atau jelajahi tren terkini untuk inspirasi gayamu hari ini.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full max-w-4xl">
        {{-- BUTTONS (Code abang yang lama) --}}
        {{-- OPTION 1: DAILY AI --}}
        <button onclick="showActivityModal()" 
            class="group relative bg-white border border-neutral-200 rounded-3xl p-10 text-left hover:border-neutral-900 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
            <div class="w-14 h-14 bg-neutral-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-neutral-900 transition-colors">
                <svg class="w-7 h-7 text-neutral-900 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
            </div>
            <h3 class="text-2xl font-bold text-neutral-900 mb-2">Daily Match</h3>
            <p class="text-neutral-500 mb-6">Rekomendasi outfit instan berdasarkan agenda dan cuaca harimu.</p>
            <span class="inline-flex items-center text-sm font-semibold text-neutral-900 group-hover:underline">
                Generate Now <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </span>
        </button>

        {{-- OPTION 2: TRENDS --}}
        <a href="{{ route('find-outfit.trend') }}" 
            class="group relative bg-white border border-neutral-200 rounded-3xl p-10 text-left hover:border-neutral-900 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
            <div class="w-14 h-14 bg-neutral-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-neutral-900 transition-colors">
                <svg class="w-7 h-7 text-neutral-900 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            </div>
            <h3 class="text-2xl font-bold text-neutral-900 mb-2">Explore Trends</h3>
            <p class="text-neutral-500 mb-6">Lihat apa yang sedang hype di TikTok dan recreate dengan bajumu.</p>
            <span class="inline-flex items-center text-sm font-semibold text-neutral-900 group-hover:underline">
                Browse Trends <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </span>
        </a>
    </div>
</div>

{{-- MODERN MODAL --}}
<div id="activityModal" class="hidden fixed inset-0 z-40">
    <div class="absolute inset-0 bg-neutral-900/60 backdrop-blur-sm transition-opacity" onclick="closeActivityModal()"></div>
    
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-lg rounded-3xl shadow-2xl p-8 animate-fade-in-up transform transition-all">
            
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-neutral-900">What's the plan?</h2>
                    <p class="text-sm text-neutral-500 mt-1" id="todayDate"></p>
                </div>
                <button type="button" onclick="closeActivityModal()" class="w-10 h-10 rounded-full bg-neutral-100 flex items-center justify-center hover:bg-neutral-200 transition">
                    <svg class="w-5 h-5 text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form action="{{ route('find-outfit.generate') }}" method="POST" id="generateForm">
                @csrf
                {{-- Opsi Kegiatan --}}
                <div class="grid grid-cols-2 gap-3 mb-6">
                    @php
                        $activities = [
                            ['id' => 'kerja_kuliah', 'emoji' => '💼', 'label' => 'Work / Uni'],
                            ['id' => 'santai', 'emoji' => '☕', 'label' => 'Chill / Cafe'],
                            ['id' => 'hangout', 'emoji' => '🎉', 'label' => 'Hangout'],
                            ['id' => 'formal', 'emoji' => '👔', 'label' => 'Formal Event'],
                            ['id' => 'kencan', 'emoji' => '🖤', 'label' => 'Date Night'],
                            ['id' => 'sport', 'emoji' => '🏃', 'label' => 'Sport / Gym'],
                        ];
                    @endphp

                    @foreach($activities as $act)
                    <label class="cursor-pointer">
                        <input type="radio" name="activity" value="{{ $act['id'] }}" class="peer hidden" onchange="hideCustomInput()">
                        <div class="border border-neutral-200 bg-neutral-50 rounded-xl p-4 text-center hover:bg-white hover:border-neutral-300 hover:shadow-md peer-checked:bg-neutral-900 peer-checked:text-white peer-checked:border-neutral-900 transition-all duration-200">
                            <div class="text-2xl mb-1">{{ $act['emoji'] }}</div>
                            <div class="text-sm font-medium">{{ $act['label'] }}</div>
                        </div>
                    </label>
                    @endforeach
                </div>

                {{-- Custom Option --}}
                <div class="mb-6">
                    <label class="cursor-pointer block">
                        <input type="radio" name="activity" value="custom" class="peer hidden" onchange="showCustomInput()">
                        <div class="border border-dashed border-neutral-300 rounded-xl p-4 flex items-center justify-center gap-2 text-neutral-500 hover:bg-neutral-50 hover:border-neutral-400 peer-checked:border-neutral-900 peer-checked:text-neutral-900 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            <span class="font-medium">Tulis aktivitas spesifik...</span>
                        </div>
                    </label>
                    
                    <div id="customActivityInput" class="hidden mt-3 animate-fade-in">
                        <textarea name="custom_activity" id="customActivityText" rows="2" 
                            placeholder="Contoh: Mau presentasi penting di depan klien, butuh look profesional..."
                            class="w-full bg-neutral-50 border border-neutral-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-neutral-900 resize-none"></textarea>
                    </div>
                </div>

                <button type="submit" class="w-full bg-neutral-900 text-white font-bold py-4 rounded-xl hover:bg-black transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                    Generate My Outfit
                </button>
            </form>
        </div>
    </div>
</div>

{{-- LOADING OVERLAY (ANIMASI NGEKOCOK) --}}
{{-- Ini akan muncul pas form disubmit --}}
<div id="loadingOverlay" class="hidden fixed inset-0 z-[60] bg-white/95 backdrop-blur-md flex flex-col items-center justify-center">
    <div class="relative w-24 h-24 mb-6">
        {{-- Circle Background --}}
        <div class="absolute inset-0 bg-neutral-100 rounded-full animate-ping opacity-75"></div>
        <div class="relative bg-white border-2 border-neutral-100 w-full h-full rounded-full flex items-center justify-center shadow-xl">
            {{-- Emojis yang gonta ganti --}}
            <span id="shufflingEmoji" class="text-5xl animate-bounce">👕</span>
        </div>
    </div>
    
    <h3 class="text-2xl font-bold text-neutral-900 mb-2">Mixing Your Wardrobe...</h3>
    <p class="text-neutral-500 animate-pulse">AI is checking your collection</p>
    
    {{-- Progress Bar Aesthetic --}}
    <div class="w-64 h-2 bg-neutral-100 rounded-full mt-6 overflow-hidden">
        <div class="h-full bg-neutral-900 animate-[width_2s_ease-in-out_infinite]" style="width: 30%"></div>
    </div>
</div>

<script>
    // === Logic Modal ===
    function showActivityModal() {
        document.getElementById('activityModal').classList.remove('hidden');
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const today = new Date().toLocaleDateString('id-ID', options);
        document.getElementById('todayDate').textContent = today;
    }

    function closeActivityModal() {
        document.getElementById('activityModal').classList.add('hidden');
    }

    function showCustomInput() {
        document.getElementById('customActivityInput').classList.remove('hidden');
        document.getElementById('customActivityText').setAttribute('required', 'required');
        document.getElementById('customActivityText').focus();
    }

    function hideCustomInput() {
        document.getElementById('customActivityInput').classList.add('hidden');
        document.getElementById('customActivityText').removeAttribute('required');
    }

    // === Logic Animasi Loading ===
    document.getElementById('generateForm').addEventListener('submit', function(e) {
        // Jangan preventDefault karena kita mau form-nya tetap submit ke server
        // Kita cuma mau nampilin overlay visual aja sebelum halaman reload/pindah
        
        const modal = document.getElementById('activityModal');
        const overlay = document.getElementById('loadingOverlay');
        const emojiEl = document.getElementById('shufflingEmoji');
        
        // Hide modal, show loading
        modal.classList.add('hidden');
        overlay.classList.remove('hidden');

        // Array icon baju
        const fashionEmojis = ['👕', '🧥', '👔', '👖', '🩳', '👗', '👟', '👞', '🧢', '🕶️'];
        let index = 0;

        // Efek slot machine (ganti emoji tiap 100ms)
        setInterval(() => {
            emojiEl.innerText = fashionEmojis[index];
            index = (index + 1) % fashionEmojis.length;
        }, 120);
    });
</script>

<style>
    /* Custom Keyframe untuk progress bar */
    @keyframes width {
        0% { width: 0%; }
        50% { width: 70%; }
        100% { width: 100%; }
    }
</style>
@endsection