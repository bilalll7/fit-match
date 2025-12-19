@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-white flex items-center justify-center px-6">

    <div class="max-w-4xl w-full">

        {{-- HEADER --}}
        <div class="text-center mb-14">
            <h1 class="text-4xl font-bold text-gray-800">
                Find Your Outfit
            </h1>
            <p class="text-gray-500 mt-3">
                Pilih mode rekomendasi outfit sesuai kebutuhanmu
            </p>
        </div>

        {{-- MODE SELECTION --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- DAILY --}}
            <div class="bg-white rounded-3xl shadow-lg p-8 text-center
                        hover:shadow-xl transition group">

                <div class="text-5xl mb-4">📅</div>

                <h3 class="text-xl font-semibold mb-2">
                    Daily Outfit
                </h3>

                <p class="text-gray-500 text-sm mb-6">
                    Outfit otomatis berdasarkan hari
                </p>

                {{-- FORM DAILY --}}
                <form action="{{ route('find-outfit.generate') }}" method="POST">
                    @csrf

                    <select name="day"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 mb-4
                               focus:ring-2 focus:ring-green-400 focus:outline-none">
                        @foreach($days as $day)
                            <option value="{{ $day }}">{{ $day }}</option>
                        @endforeach
                    </select>

                    <button type="submit"
                        class="w-full bg-green-500 hover:bg-green-600
                               text-white font-semibold py-3 rounded-xl transition">
                        Generate
                    </button>
                </form>
            </div>

            {{-- EVENT --}}
            <div class="bg-white rounded-3xl shadow-lg p-8 text-center
                        hover:shadow-xl transition">

                <div class="text-5xl mb-4">🎉</div>

                <h3 class="text-xl font-semibold mb-2">
                    Event Outfit
                </h3>

                <p class="text-gray-500 text-sm mb-6">
                    Outfit khusus untuk acara tertentu
                </p>

                <a href="{{ route('find-outfit.event') }}"
                   class="inline-block bg-gray-100 hover:bg-gray-200
                          text-gray-700 font-medium px-6 py-3 rounded-xl transition">
                    Pilih Event
                </a>
            </div>

            {{-- TREND --}}
            <div class="bg-white rounded-3xl shadow-lg p-8 text-center
                        hover:shadow-xl transition">

                <div class="text-5xl mb-4">🔥</div>

                <h3 class="text-xl font-semibold mb-2">
                    Trend Outfit
                </h3>

                <p class="text-gray-500 text-sm mb-6">
                    Rekomendasi outfit yang sedang tren
                </p>

                <a href="{{ route('find-outfit.trend') }}"
                   class="inline-block bg-gray-100 hover:bg-gray-200
                          text-gray-700 font-medium px-6 py-3 rounded-xl transition">
                    Lihat Trend
                </a>
            </div>

        </div>
    </div>

</div>
@endsection
