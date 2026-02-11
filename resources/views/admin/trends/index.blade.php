@extends('admin.layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-black text-neutral-900 tracking-tight">Trend Outfit</h1>
            <p class="text-neutral-500 mt-1 text-sm">Kelola inspirasi dan video trend terkini.</p>
        </div>
        <a href="{{ route('admin.trends.create') }}"
           class="bg-neutral-900 hover:bg-neutral-800 text-white px-6 py-3 rounded-xl font-bold text-sm shadow-lg transition transform hover:scale-105">
            + Tambah Trend
        </a>
    </div>

    {{-- EMPTY STATE --}}
    @if($trends->isEmpty())
        <div class="bg-white rounded-3xl p-12 text-center border border-neutral-100 shadow-sm">
            <div class="bg-neutral-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <h3 class="text-lg font-bold text-neutral-900">Belum ada trend</h3>
            <p class="text-neutral-500 text-sm mt-1">Silakan tambah trend baru untuk memulai.</p>
        </div>
    @else
        {{-- LIST TRENDS --}}
        <div class="grid grid-cols-1 gap-8">
            @foreach($trends as $trend)
                <div class="bg-white rounded-3xl shadow-[0_4px_20px_rgb(0,0,0,0.03)] border border-neutral-100 overflow-hidden group hover:shadow-[0_4px_25px_rgb(0,0,0,0.06)] transition duration-300">
                    
                    <div class="p-6 md:p-8">
                        <div class="flex flex-col md:flex-row gap-6 items-start">
                            
                            {{-- Cover Image --}}
                            <div class="shrink-0">
                                @if($trend->cover_image)
                                    <img src="{{ asset('storage/'.$trend->cover_image) }}" class="w-32 h-32 md:w-40 md:h-40 object-cover rounded-2xl shadow-sm border border-neutral-100">
                                @else
                                    <div class="w-32 h-32 md:w-40 md:h-40 bg-neutral-100 rounded-2xl flex items-center justify-center text-neutral-400">
                                        No Image
                                    </div>
                                @endif
                            </div>

                            {{-- Content --}}
                            <div class="flex-1 w-full">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-xl font-bold text-neutral-900">{{ $trend->title }}</h3>
                                        <p class="text-neutral-500 text-sm mt-2 leading-relaxed max-w-2xl">{{ Str::limit($trend->description, 120) }}</p>
                                    </div>
                                    
                                    {{-- Actions (Edit & Toggle) --}}
                                    <div class="flex flex-col gap-2 items-end">
                                         <form method="POST" action="{{ route('admin.trends.toggle', $trend) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button class="px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider transition
                                                {{ $trend->is_active ? 'bg-neutral-900 text-white' : 'bg-neutral-200 text-neutral-500' }}">
                                                {{ $trend->is_active ? 'Active' : 'Inactive' }}
                                            </button>
                                        </form>

                                        <a href="{{ route('admin.trends.edit', $trend) }}" 
                                           class="text-xs font-bold text-neutral-500 hover:text-neutral-900 underline underline-offset-4 decoration-2">
                                            Edit Trend
                                        </a>
                                    </div>
                                </div>

                                <hr class="my-6 border-neutral-100">

                                {{-- TikTok Section --}}
                                <div>
                                    <h4 class="text-sm font-bold text-neutral-900 mb-3 flex items-center gap-2">
                                        <span class="w-2 h-2 bg-neutral-900 rounded-full"></span>
                                        Linked TikToks
                                    </h4>
                                    
                                    @if($trend->tiktoks->isNotEmpty())
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            @foreach($trend->tiktoks as $tiktok)
                                                <a href="{{ $tiktok->tiktok_url }}" target="_blank" 
                                                   class="inline-flex items-center gap-2 px-3 py-1.5 bg-neutral-50 border border-neutral-200 rounded-lg text-xs font-medium text-neutral-600 hover:bg-neutral-100 hover:border-neutral-300 transition">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M19.589 6.686a4.793 4.793 0 0 1-3.77-4.245V2h-3.445v13.672a2.896 2.896 0 0 1-5.201 1.743l-.002-.001.002.001a2.895 2.895 0 0 1 3.183-4.51v-3.5a6.329 6.329 0 0 0-5.394 10.692 6.33 6.33 0 0 0 10.857-4.424V8.687a8.182 8.182 0 0 0 4.773 1.526V6.79a4.831 4.831 0 0 1-1.003-.104z"/></svg>
                                                    {{ $tiktok->caption ?? 'Video Link' }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif

                                    {{-- Quick Add Form --}}
                                    <form method="POST" action="{{ route('admin.trends.tiktoks.store', $trend) }}" class="flex gap-2">
                                        @csrf
                                        <input type="text" name="tiktok_url" placeholder="Paste URL TikTok..." 
                                               class="flex-1 bg-neutral-50 border border-neutral-200 rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-neutral-900 focus:outline-none">
                                        <input type="text" name="caption" placeholder="Caption" 
                                               class="w-1/4 bg-neutral-50 border border-neutral-200 rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-neutral-900 focus:outline-none hidden md:block">
                                        <button type="submit" class="bg-neutral-900 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-neutral-700 transition">
                                            + Add
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection