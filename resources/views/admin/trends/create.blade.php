@extends('admin.layouts.app')

@section('content')
<div class="p-8">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">
            Tambah Trend
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Tambahkan trend outfit terbaru
        </p>
    </div>

    {{-- CARD FORM --}}
    <div class="bg-white rounded-2xl shadow-md p-8 max-w-2xl">

        <form method="POST"
              action="{{ route('admin.trends.store') }}"
              enctype="multipart/form-data"
              class="space-y-6">

            @csrf

            {{-- JUDUL --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Judul Trend
                </label>
                <input type="text"
                       name="title"
                       placeholder="Masukkan judul trend"
                       class="w-full border border-gray-300 px-4 py-3 rounded-xl
                              focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>

            {{-- DESKRIPSI --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Deskripsi Trend
                </label>
                <textarea name="description"
                          rows="4"
                          placeholder="Masukkan deskripsi trend"
                          class="w-full border border-gray-300 px-4 py-3 rounded-xl
                                 focus:outline-none focus:ring-2 focus:ring-green-400"></textarea>
            </div>

            {{-- GAMBAR --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Gambar Trend
                </label>
                <input type="file"
                       name="image"
                       class="w-full border border-dashed border-gray-300 p-3 rounded-xl
                              bg-gray-50 cursor-pointer">
            </div>

            {{-- ACTION --}}
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('admin.trends.index') }}"
                   class="px-6 py-3 rounded-xl border border-gray-300 text-gray-600 hover:bg-gray-100">
                    Batal
                </a>

                <button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white px-6 py-3
                               rounded-xl font-semibold shadow transition">
                    Simpan Trend
                </button>
            </div>

        </form>
    </div>
</div>
@endsection