@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-24 px-6">

    <h1 class="text-3xl font-bold mb-10 text-center">
        Outfit Trends 🔥
    </h1>

    @if($trends->isEmpty())
        <p class="text-center text-gray-500">
            Belum ada trend outfit saat ini.
        </p>
    @endif

    <div class="grid md:grid-cols-2 gap-10">
        @foreach($trends as $trend)
            <div class="bg-white rounded-3xl shadow-lg p-6">

                {{-- TREND IMAGE --}}
                @if($trend->image)
                    <img src="{{ asset('storage/'.$trend->image) }}"
                         class="rounded-2xl mb-4 w-full h-56 object-cover">
                @endif

                <h2 class="text-xl font-semibold mb-2">
                    {{ $trend->title }}
                </h2>

                <p class="text-gray-600 text-sm mb-4">
                    {{ $trend->description }}
                </p>

                {{-- TIKTOK LIST --}}
                @if($trend->tiktoks->count())
                    <div class="space-y-3">
                        @foreach($trend->tiktoks as $tt)
                            <a href="{{ $tt->tiktok_url }}" target="_blank"
                               class="flex items-center gap-4 p-3 border rounded-xl hover:bg-gray-50">

                                @if($tt->thumbnail)
                                    <img src="{{ asset('storage/'.$tt->thumbnail) }}"
                                         class="w-16 h-16 rounded-lg object-cover">
                                @endif

                                <div>
                                    <p class="font-medium">
                                        {{ $tt->creator_name ?? 'TikTok Creator' }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ $tt->caption }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif

            </div>
        @endforeach
    </div>

</div>
@endsection
