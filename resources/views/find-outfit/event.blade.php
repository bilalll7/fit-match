@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-24 text-center">

    <h1 class="text-3xl font-semibold mb-8">
        Event Outfit Recommendation
    </h1>

    @if(session('error'))
        <p class="text-red-500 mb-4">
            {{ session('error') }}
        </p>
    @endif

<form action="{{ route('find-outfit.event.generate') }}"
      method="POST"
      onsubmit="startShuffle()">
    @csrf

    <select name="event"
        class="w-full border rounded-xl px-4 py-3 mb-6">
        @foreach($events as $key => $label)
            <option value="{{ $key }}">{{ $label }}</option>
        @endforeach
    </select>

    <button
        type="submit"
        class="bg-purple-600 text-white px-8 py-3 rounded-full">
        Generate Outfit
    </button>
</form>

<div id="shuffleBox" class="hidden mt-12 text-center">
    <img src="/images/shuffle.png"
         class="mx-auto w-24 animate-spin-slow">
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
