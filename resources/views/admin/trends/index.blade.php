@extends('admin.layouts.app')

@section('content')
<div class="p-8 max-w-5xl mx-auto">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Trend Outfit</h1>
        <a href="{{ route('admin.trends.create') }}"
           class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-xl font-semibold shadow">
            + Tambah Trend
        </a>
    </div>

    {{-- Jika tidak ada trend --}}
    @if($trends->isEmpty())
        <p class="text-gray-500 text-center py-12">Belum ada trend outfit saat ini.</p>
    @else
        <div class="space-y-6">
            @foreach($trends as $trend)
                <div class="bg-white rounded-2xl shadow-md p-6">

                    {{-- Trend utama --}}
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex gap-4">
                            @if($trend->cover_image)
                                <img src="{{ asset('storage/'.$trend->cover_image) }}" class="w-24 h-24 object-cover rounded-xl">
                            @endif
                            <div>
                                <h3 class="font-semibold">{{ $trend->title }}</h3>
                                <p class="text-gray-500 text-sm">{{ Str::limit($trend->description, 80) }}</p>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            {{-- Toggle aktif --}}
                            <form method="POST" action="{{ route('admin.trends.toggle', $trend) }}">
                                @csrf
                                @method('PATCH')
                                <button class="px-4 py-2 rounded-lg {{ $trend->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-200' }}">
                                    {{ $trend->is_active ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </form>

                            {{-- Edit trend --}}
                            <a href="{{ route('admin.trends.edit', $trend) }}" class="text-blue-500 px-4 py-2 border rounded-lg hover:bg-gray-50">
                                Edit
                            </a>
                        </div>
                    </div>

                    {{-- TikTok list --}}
                    @if($trend->tiktoks->isNotEmpty())
                        <div class="mb-4">
                            <h4 class="font-semibold mb-2">TikTok List:</h4>
                            <ul class="space-y-1">
                                @foreach($trend->tiktoks as $tiktok)
                                    <li>
                                        🎵 <a href="{{ $tiktok->tiktok_url }}" target="_blank">{{ $tiktok->caption ?? 'View TikTok' }}</a>
                                        @if($tiktok->creator_name) - {{ $tiktok->creator_name }} @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Form tambah TikTok --}}
                    <form method="POST" action="{{ route('admin.trends.tiktoks.store', $trend) }}" class="space-y-2">
                        @csrf
                        <div class="flex gap-2">
                            <input type="text" name="tiktok_url" placeholder="URL TikTok" class="w-1/3 border p-2 rounded" required>
                            <input type="text" name="caption" placeholder="Caption" class="w-1/3 border p-2 rounded">
                            <input type="text" name="creator_name" placeholder="Creator Name" class="w-1/3 border p-2 rounded">
                            <button type="submit" class="bg-green-500 text-white px-4 rounded hover:bg-green-600 transition">Tambah</button>
                        </div>
                    </form>

                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
