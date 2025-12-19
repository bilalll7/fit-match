@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-24">

    {{-- HEADER --}}
    <div class="text-center mb-14">
        <h1 class="text-3xl font-bold text-gray-800">
            Rekomendasi Outfit Hari {{ $day }}
        </h1>
        <p class="text-gray-500 mt-2">
            Outfit ini dipilih khusus berdasarkan koleksi kamu
        </p>
    </div>

    {{-- OUTFIT GRID --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-8">

        @foreach($outfits as $outfit)
        <div class="bg-white rounded-3xl shadow hover:shadow-xl transition
                    overflow-hidden group">

            <div class="relative">
                <img src="{{ asset('storage/'.$outfit->image) }}"
                     class="h-56 w-full object-cover
                            group-hover:scale-105 transition">

                <span class="absolute top-3 left-3
                             bg-green-500 text-white text-xs
                             px-3 py-1 rounded-full shadow">
                    {{ $outfit->category->name }}
                </span>
            </div>

            <div class="p-4 text-center">
                <h3 class="font-semibold text-gray-700">
                    {{ $outfit->name }}
                </h3>
            </div>
        </div>
        @endforeach

    </div>

    {{-- ACTION --}}
    <div class="text-center mt-16">
        <a href="{{ route('find-outfit.index') }}"
           class="inline-block bg-gray-100 hover:bg-gray-200
                  text-gray-700 font-medium
                  px-8 py-3 rounded-full transition">
            🔄 Generate Ulang
        </a>
    </div>

</div>
@endsection
