@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto py-10">

    <div class="flex justify-between mb-8">
        <h1 class="text-2xl font-bold">Trend Outfit</h1>

        <a href="{{ route('admin.trends.create') }}"
           class="bg-green-500 text-white px-6 py-3 rounded-xl">
            + Tambah Trend
        </a>
    </div>

    <div class="space-y-6">
        @foreach($trends as $trend)
            <div class="bg-white p-6 rounded-xl shadow flex justify-between">

                <div class="flex gap-4">
                    <img src="{{ asset('storage/'.$trend->cover_image) }}"
                         class="w-24 h-24 rounded-xl object-cover">

                    <div>
                        <h3 class="font-semibold">{{ $trend->title }}</h3>
                        <p class="text-gray-500 text-sm">
                            {{ Str::limit($trend->description, 80) }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <form method="POST"
                          action="{{ route('admin.trends.toggle', $trend) }}">
                        @csrf @method('PATCH')
                        <button class="px-4 py-2 rounded-lg
                            {{ $trend->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-200' }}">
                            {{ $trend->is_active ? 'Aktif' : 'Nonaktif' }}
                        </button>
                    </form>

                    <a href="{{ route('admin.trends.edit', $trend) }}"
                       class="text-blue-500">
                        Edit
                    </a>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
