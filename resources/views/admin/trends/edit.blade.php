@extends('admin.layouts.app')

@section('content')
<div class="p-8 max-w-4xl mx-auto relative">

    {{-- Tombol Back --}}
    <a href="{{ route('admin.trends.index') }}" 
       class="absolute top-4 left-4 inline-flex items-center px-3 py-1 bg-white border border-gray-200 text-gray-700 rounded-lg shadow-sm hover:bg-gray-100 transition duration-200 text-sm font-medium z-10">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali
    </a>

    <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Edit Trend: {{ $trend->title }}</h1>

    {{-- Form edit trend --}}
    <div class="bg-white rounded-2xl shadow-md p-6 mb-8">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif
        <form method="POST" action="{{ route('admin.trends.update', $trend) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <input type="text" name="title" value="{{ old('title', $trend->title) }}" 
                   class="w-full border border-gray-300 px-4 py-2 rounded-xl" placeholder="Judul Trend">

            <textarea name="description" rows="4" 
                      class="w-full border border-gray-300 px-4 py-2 rounded-xl" placeholder="Deskripsi Trend">{{ old('description', $trend->description) }}</textarea>

            @if($trend->cover_image)
                <img src="{{ asset('storage/'.$trend->cover_image) }}" class="w-48 h-48 object-cover rounded mb-3">
            @endif

            <input type="file" name="image" class="w-full border border-dashed border-gray-300 p-3 rounded-xl bg-gray-50 cursor-pointer">

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-xl font-semibold shadow transition">
                Simpan Perubahan
            </button>
        </form>
    </div>

    {{-- Form tambah TikTok --}}
    <div class="bg-white rounded-2xl shadow-md p-6 mb-8">
        <h2 class="text-lg font-semibold mb-4">Tambahkan TikTok ke Trend</h2>
        <form method="POST" action="{{ route('admin.trends.tiktoks.store', $trend) }}" class="space-y-4">
            @csrf
            <input type="text" name="tiktok_url" placeholder="URL TikTok" class="w-full border px-4 py-2 rounded-xl">
            <input type="text" name="caption" placeholder="Caption (Opsional)" class="w-full border px-4 py-2 rounded-xl">
            <input type="text" name="creator_name" placeholder="Creator Name (Opsional)" class="w-full border px-4 py-2 rounded-xl">
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-xl font-semibold shadow">
                Tambah TikTok
            </button>
        </form>
    </div>

    {{-- List TikTok --}}
    @if($trend->tiktoks->isNotEmpty())
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h3 class="text-lg font-semibold mb-4">Daftar TikTok</h3>
            <ul class="space-y-2">
    @foreach($trend->tiktoks as $tiktok)
        <li class="flex justify-between items-center border-b border-gray-200 py-2">
            <div>
                🎵 {{ $tiktok->caption ?? 'View TikTok' }}
                @if($tiktok->creator_name) - {{ $tiktok->creator_name }} @endif
            </div>
            <div class="flex gap-2">
                <a href="{{ $tiktok->tiktok_url }}" target="_blank" class="text-blue-500 hover:underline text-sm">Lihat</a>
                
                 <form method="POST" action="{{ route('admin.trends.tiktoks.destroy', $tiktok) }}" class="inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-red-500 hover:underline"
            onclick="return confirm('Yakin ingin menghapus TikTok ini?')">
        Hapus
    </button>
</form>





            </div>
        </li>
    @endforeach
</ul>

        </div>
    @endif

</div>
@endsection
