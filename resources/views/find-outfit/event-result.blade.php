@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-20 px-6">

   <h1 class="text-3xl font-semibold text-center mb-4">
    Outfit untuk {{ ucfirst(str_replace('_', ' ', $event)) }}
   </h1>

   <p class="text-center text-gray-500 mb-8">
    Dipilih khusus berdasarkan koleksi kamu
   </p>

   {{-- AI BADGE --}}
   <div class="text-center mb-8">
       <span class="inline-block px-4 py-2 bg-gradient-to-r from-purple-100 to-pink-100 text-purple-700 rounded-full text-sm font-medium">
           ✨ Powered by Gemini AI
       </span>
   </div>

   {{-- AI STYLING TIPS --}}
   @if(isset($ai_tips))
   <div class="mb-10 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-3xl p-6 border border-blue-200 shadow-sm">
       <div class="flex items-start gap-4">
           <div class="text-3xl flex-shrink-0">💡</div>
           <div>
               <h3 class="font-semibold text-gray-800 mb-2 text-lg">Styling Tips</h3>
               <p class="text-gray-600 leading-relaxed">
                   {{ $ai_tips }}
               </p>
           </div>
       </div>
   </div>
   @endif

   {{-- OUTFIT GRID --}}
   <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
    @foreach($outfits as $item)
        <div class="rounded-2xl p-5 text-center shadow hover:shadow-xl transition bg-white">

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
       class="inline-block border px-6 py-3 rounded-full hover:bg-gray-100 transition">
        Generate ulang
    </a>
   </div>

</div>
@endsection