@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto py-10">

    <h1 class="text-2xl font-bold mb-6">Edit Trend Outfit</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST"
          action="{{ route('admin.trends.update', $trend) }}"
          enctype="multipart/form-data"
          class="space-y-6">

        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 font-semibold">Judul Trend</label>
            <input type="text"
                   name="title"
                   value="{{ old('title', $trend->title) }}"
                   class="w-full border p-3 rounded-xl @error('title') border-red-500 @enderror">
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block mb-1 font-semibold">Deskripsi Trend</label>
            <textarea name="description"
                      class="w-full border p-3 rounded-xl @error('description') border-red-500 @enderror"
                      rows="4">{{ old('description', $trend->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block mb-1 font-semibold">Gambar Trend</label>
            @if($trend->cover_image)
                <img src="{{ asset('storage/'.$trend->cover_image) }}"
                     alt="{{ $trend->title }}"
                     class="w-48 h-48 object-cover rounded mb-3">
            @endif
            <input type="file" name="image" class="w-full">
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-4">
            <button type="submit"
                    class="bg-blue-500 text-white px-6 py-3 rounded-xl">
                Simpan Perubahan
            </button>

            <a href="{{ route('admin.trends.index') }}"
               class="bg-gray-200 px-6 py-3 rounded-xl">
                Batal
            </a>
        </div>
    </form>

</div>
@endsection
