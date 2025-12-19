@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-24 text-center">

    {{-- Tombol Kembali --}}
    <div class="mb-9 text-left">
        <a href="{{ route('find-outfit.index') }}" 
           class="inline-flex items-center px-5 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg shadow hover:bg-gray-100 hover:shadow-md transition duration-200 font-medium">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Find Outfit
        </a>
    </div>

    <h1 class="text-3xl font-semibold mb-8">
        Event Outfit Recommendation
    </h1>

    @if(session('error'))
        <p class="text-red-500 mb-4">
            {{ session('error') }}
        </p>
    @endif

    <form action="{{ route('find-outfit.event.generate') }}" method="POST" onsubmit="startShuffle()">
        @csrf

        <select name="event" class="w-full border rounded-xl px-4 py-3 mb-6">
            @foreach($events as $key => $label)
                <option value="{{ $key }}">{{ $label }}</option>
            @endforeach
        </select>

        <button type="submit" class="bg-purple-600 text-white px-8 py-3 rounded-full hover:bg-purple-700 transition">
            Generate Outfit
        </button>
    </form>

    {{-- Shuffle animation --}}
    <div id="shuffleBox" class="hidden mt-12 text-center">
        <img src="/images/shuffle.png" class="mx-auto w-24 animate-spin-slow">
        <p class="text-gray-500 mt-4">
            Mengacak outfit terbaik...
        </p>
    </div>

    <style>
        @keyframes spinSlow {
            from { transform: rotate(0deg); }
            to   { transform: rotate(360deg); }
        }

        .animate-spin-slow {
            animation: spinSlow 1.2s linear infinite;
        }
    </style>

    <script>
        function startShuffle() {
            document.getElementById('shuffleBox').classList.remove('hidden');
        }
    </script>

</div>
@endsection
