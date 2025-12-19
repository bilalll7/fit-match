@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">

    <h1 class="text-2xl font-bold mb-6">
        Daily Outfit Recommendation
    </h1>

    @include('partials.tabs')

    <div class="space-y-8">

        @foreach($weeklyOutfits as $dayOutfit)
        <div class="bg-white rounded-2xl shadow p-6">

            <h2 class="text-lg font-semibold mb-4 text-emerald-600">
                {{ $dayOutfit['day'] }}
            </h2>

            @if(count($dayOutfit['items']) > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                    @foreach($dayOutfit['items'] as $item)
                        <div class="text-center">
                            <img src="{{ asset('storage/'.$item->image) }}"
                                 class="h-32 w-full object-cover rounded-xl mb-2">

                            <p class="text-sm text-gray-600">
                                {{ $item->category->name }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-red-500 italic">
                    Kamu belum upload item outfit.
                </p>
            @endif

        </div>
        @endforeach

    </div>

</div>
@endsection
