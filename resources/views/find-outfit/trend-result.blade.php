@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-16">

    <div class="flex flex-col items-center text-center mb-16">
        <span class="text-neutral-500 font-medium mb-2">Recreated Look For</span>
        <h1 class="text-4xl font-bold text-neutral-900 mb-4">{{ $trend->title }}</h1>
        <div class="h-1 w-20 bg-neutral-900"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        
        {{-- LEFT SIDE: THE OUTFIT --}}
        <div class="lg:col-span-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($outfits as $outfit)
                <div class="bg-white rounded-2xl border border-neutral-100 p-2 shadow-sm hover:shadow-md transition">
                    <div class="aspect-[4/5] rounded-xl overflow-hidden bg-neutral-50 mb-3">
                        <img src="{{ asset('storage/'.$outfit->image) }}" class="w-full h-full object-cover">
                    </div>
                    <div class="px-2 pb-2">
                        <p class="text-xs text-neutral-500 uppercase tracking-wider mb-1">{{ $outfit->category->name }}</p>
                        <h3 class="font-bold text-neutral-900 text-sm truncate">{{ $outfit->name }}</h3>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-12 flex justify-center gap-4">
                <a href="{{ route('find-outfit.trend.show', $trend) }}" class="px-8 py-3 bg-neutral-100 text-neutral-900 font-bold rounded-xl hover:bg-neutral-200 transition">
                    Back to Trend
                </a>
                <a href="{{ route('find-outfit.trend') }}" class="px-8 py-3 bg-neutral-900 text-white font-bold rounded-xl hover:bg-black transition shadow-lg">
                    Browse Other Trends
                </a>
            </div>
        </div>

        {{-- RIGHT SIDE: AI ANALYSIS --}}
        <div class="lg:col-span-4 space-y-6">
            {{-- Reasoning --}}
            @if(isset($ai_reasoning))
            <div class="bg-neutral-900 text-white p-8 rounded-3xl relative overflow-hidden">
                 <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full blur-3xl -mr-10 -mt-10"></div>
                <h3 class="font-bold text-lg mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    The Match Logic
                </h3>
                <p class="text-neutral-300 text-sm leading-relaxed">
                    {{ $ai_reasoning }}
                </p>
            </div>
            @endif

            {{-- Tips --}}
            @if(isset($tips))
            <div class="bg-white border border-neutral-200 p-8 rounded-3xl">
                <h3 class="font-bold text-neutral-900 text-lg mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-neutral-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                    Pro Styling Tips
                </h3>
                <p class="text-neutral-600 text-sm leading-relaxed">
                    {{ $tips }}
                </p>
            </div>
            @endif
        </div>

    </div>
</div>
@endsection