@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">

    {{-- Stylish Back Button --}}
    <div class="mb-6">
        <a href="{{ route('find-outfit.index') }}" 
           class="inline-flex items-center px-5 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg shadow hover:bg-gray-100 hover:shadow-md transition duration-200 font-medium">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Find Outfit
        </a>
    </div>

    <h1 class="text-3xl font-bold mb-6 text-center">Trend Outfit</h1>

    @if($trends->isEmpty())
        <p class="text-gray-500 text-center">Belum ada trend outfit saat ini.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($trends as $trend)
                <div class="bg-white rounded-xl shadow-md overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-xl">
                    
                    {{-- Gambar trend --}}
                    <img src="{{ asset('storage/'.$trend->cover_image) }}" 
                         alt="{{ $trend->title }}" 
                         class="w-full h-56 object-cover">

                    <div class="p-4">
                        {{-- Judul dan deskripsi --}}
                        <h3 class="font-bold text-lg mb-2">{{ $trend->title }}</h3>
                        <p class="text-gray-500 text-sm mb-4">{{ Str::limit($trend->description, 100) }}</p>

                        {{-- Daftar TikTok --}}
                        @if($trend->tiktoks->isNotEmpty())
                            <h4 class="font-semibold mb-2">TikTok:</h4>
                            <ul class="space-y-2">
                                @foreach($trend->tiktoks as $tiktok)
                                    <li class="flex justify-between items-center text-sm">
                                        <span>
                                            🎵 {{ $tiktok->caption ?? 'View TikTok' }}
                                            @if($tiktok->creator_name) - {{ $tiktok->creator_name }} @endif
                                        </span>
                                        <a href="{{ $tiktok->tiktok_url }}" target="_blank" class="bg-red-500 text-white px-3 py-1 rounded-lg text-xs hover:bg-red-600 transition">
                                            Lihat
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-400 text-sm">Belum ada TikTok untuk trend ini.</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
