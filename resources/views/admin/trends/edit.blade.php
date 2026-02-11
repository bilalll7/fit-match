@extends('admin.layouts.app')

@section('content')

    {{-- HEADER WITH BACK BUTTON --}}
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.trends.index') }}" 
           class="bg-white border border-neutral-200 text-neutral-900 rounded-xl p-3 hover:bg-neutral-50 transition shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h1 class="text-3xl font-black text-neutral-900 tracking-tight">Edit Trend</h1>
            <p class="text-neutral-500 mt-1 text-sm">Update informasi trend "{{ $trend->title }}"</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- LEFT COLUMN: EDIT DETAILS --}}
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white p-8 rounded-3xl border border-neutral-100 shadow-[0_4px_20px_rgb(0,0,0,0.03)]">
                <form method="POST" action="{{ route('admin.trends.update', $trend) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
        
                    <div class="group">
                        <label class="block text-sm font-bold text-neutral-900 mb-2">Judul Trend</label>
                        <input type="text" name="title" value="{{ old('title', $trend->title) }}" 
                               class="w-full bg-neutral-50 border border-neutral-200 rounded-xl px-5 py-3 font-medium focus:bg-white focus:ring-2 focus:ring-neutral-900 focus:outline-none transition">
                    </div>
        
                    <div class="group">
                        <label class="block text-sm font-bold text-neutral-900 mb-2">Deskripsi</label>
                        <textarea name="description" rows="5" 
                                  class="w-full bg-neutral-50 border border-neutral-200 rounded-xl px-5 py-3 font-medium focus:bg-white focus:ring-2 focus:ring-neutral-900 focus:outline-none transition">{{ old('description', $trend->description) }}</textarea>
                    </div>
        
                    <div class="group">
                        <label class="block text-sm font-bold text-neutral-900 mb-2">Cover Image</label>
                        <div class="flex flex-col sm:flex-row gap-4 items-start">
                             @if($trend->cover_image)
                                <img src="{{ asset('storage/'.$trend->cover_image) }}" class="w-32 h-32 object-cover rounded-xl border border-neutral-200">
                            @endif
                            <input type="file" name="image" class="w-full border border-dashed border-neutral-300 p-4 rounded-xl bg-neutral-50 text-sm text-neutral-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-neutral-900 file:text-white hover:file:bg-neutral-700 cursor-pointer">
                        </div>
                    </div>
        
                    <button type="submit" class="w-full bg-neutral-900 hover:bg-neutral-800 text-white px-6 py-3 rounded-xl font-bold text-sm shadow-lg transition">
                        Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>

        {{-- RIGHT COLUMN: TIKTOK MANAGER --}}
        <div class="space-y-6">
            
            {{-- Form Add --}}
            <div class="bg-neutral-900 p-6 rounded-3xl text-white shadow-xl relative overflow-hidden">
                <div class="absolute top-0 right-0 w-20 h-20 bg-white/10 rounded-full blur-2xl -mr-10 -mt-10"></div>
                
                <h2 class="text-lg font-bold mb-4 relative z-10">Tambah TikTok</h2>
                <form method="POST" action="{{ route('admin.trends.tiktoks.store', $trend) }}" class="space-y-3 relative z-10">
                    @csrf
                    <input type="text" name="tiktok_url" placeholder="URL Video..." class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-2 text-sm text-white placeholder:text-white/50 focus:outline-none focus:bg-white/20 transition">
                    <input type="text" name="caption" placeholder="Caption (Judul)" class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-2 text-sm text-white placeholder:text-white/50 focus:outline-none focus:bg-white/20 transition">
                    <input type="text" name="creator_name" placeholder="Creator Name" class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-2 text-sm text-white placeholder:text-white/50 focus:outline-none focus:bg-white/20 transition">
                    
                    <button type="submit" class="w-full bg-white text-neutral-900 px-4 py-2.5 rounded-xl font-bold text-sm hover:bg-neutral-200 transition">
                        + Tambah Link
                    </button>
                </form>
            </div>

            {{-- List --}}
            @if($trend->tiktoks->isNotEmpty())
                <div class="bg-white p-6 rounded-3xl border border-neutral-100 shadow-sm">
                    <h3 class="text-sm font-bold text-neutral-900 mb-4 uppercase tracking-wider">Daftar Link</h3>
                    <ul class="space-y-3">
                        @foreach($trend->tiktoks as $tiktok)
                            <li class="group flex justify-between items-center p-3 bg-neutral-50 rounded-xl border border-neutral-100 hover:border-neutral-200 transition">
                                <div class="overflow-hidden">
                                    <p class="font-bold text-sm text-neutral-900 truncate">{{ $tiktok->caption ?? 'No Caption' }}</p>
                                    <a href="{{ $tiktok->tiktok_url }}" target="_blank" class="text-xs text-neutral-500 hover:underline truncate block">
                                        {{ $tiktok->creator_name ?? 'View Video' }}
                                    </a>
                                </div>
                                <form method="POST" action="{{ route('admin.trends.tiktoks.destroy', $tiktok) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus link ini?')" 
                                            class="p-2 text-neutral-400 hover:text-red-600 hover:bg-white rounded-lg transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

@endsection