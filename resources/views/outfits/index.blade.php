@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-24">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-3xl font-serif font-semibold">Match Your Outfit</h1>
            <p class="text-gray-600">
                Kelola koleksi pakaianmu untuk mendapatkan rekomendasi terbaik
            </p>
        </div>

        <a href="{{ route('outfits.create') }}"
           class="bg-green-500 text-white px-6 py-3 rounded-full shadow">
            + Tambah Outfit
        </a>
    </div>

    {{-- FILTER CATEGORY --}}
    <div class="flex gap-3 flex-wrap mb-12">
        <a href="{{ route('outfits.index') }}"
           class="px-5 py-2 rounded-full
           {{ request('category') ? 'bg-green-100' : 'bg-green-500 text-white' }}">
            Semua
        </a>

        @foreach($categories as $category)
            <a href="{{ route('outfits.index',['category'=>$category->name]) }}"
               class="px-5 py-2 rounded-full bg-green-100 hover:bg-green-200">
                {{ $category->name }}
            </a>
        @endforeach
    </div>

    {{-- OUTFITS GRID --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        @forelse($outfits as $outfit)
            <div class="bg-white rounded-3xl shadow overflow-hidden group">

                <img src="{{ asset('storage/'.$outfit->image) }}"
                     class="h-64 w-full object-cover group-hover:scale-105 transition">

                <div class="p-4">
                    <span class="text-xs bg-green-100 px-3 py-1 rounded-full">
                        {{ $outfit->category->name }}
                    </span>

                    <h3 class="mt-3 font-semibold">
                        {{ $outfit->name }}
                    </h3>

                    <div class="flex justify-between mt-4 text-sm">
                        <a href="{{ route('outfits.edit',$outfit) }}"
                           class="text-blue-500">
                            Edit
                        </a>

                        <form action="{{ route('outfits.destroy',$outfit) }}"
                              method="POST"
                              onsubmit="return confirm('Hapus outfit ini?')">
                            @csrf @method('DELETE')
                            <button class="text-red-500">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500">
                Belum ada outfit.
            </p>
        @endforelse
    </div>
</div>
@endsection
