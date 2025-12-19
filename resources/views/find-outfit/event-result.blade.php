@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-20">

   <h1 class="text-3xl font-semibold text-center mb-4">
    Outfit untuk
    {{ ucfirst(str_replace('_',' ', $event)) }}
</h1>

<p class="text-center text-gray-500 mb-12">
    Dipilih khusus berdasarkan koleksi kamu
</p>

<div class="grid grid-cols-1 md:grid-cols-3 gap-10">
    @foreach($outfits as $item)
        <div
          class="rounded-2xl p-5 text-center
                 shadow hover:shadow-xl transition">

            <img src="{{ asset('storage/'.$item->image) }}"
                 class="w-full h-60 object-cover rounded-xl mb-4">

            <h3 class="font-semibold text-lg">
                {{ $item->name }}
            </h3>

            <span class="text-sm text-gray-500">
                {{ $item->category->name }}
            </span>
        </div>
    @endforeach
</div>

<div class="text-center mt-16">
    <a href="{{ route('find-outfit.event') }}"
       class="inline-block border px-6 py-3 rounded-full hover:bg-gray-100">
        Generate ulang
    </a>
</div>

</div>
@endsection
