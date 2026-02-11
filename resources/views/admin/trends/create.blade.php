@extends('admin.layouts.app')

@section('content')

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-3xl font-black text-neutral-900 tracking-tight">Tambah Trend Baru</h1>
        <p class="text-neutral-500 mt-1 text-sm">Mulai buat koleksi trend outfit viral.</p>
    </div>

    {{-- FORM CARD --}}
    <div class="bg-white p-8 rounded-3xl border border-neutral-100 shadow-[0_4px_20px_rgb(0,0,0,0.03)] max-w-2xl">

        <form method="POST"
              action="{{ route('admin.trends.store') }}"
              enctype="multipart/form-data"
              class="space-y-6">

            @csrf

            {{-- JUDUL --}}
            <div class="group">
                <label class="block text-sm font-bold text-neutral-900 mb-2">Judul Trend</label>
                <input type="text" name="title" placeholder="Contoh: Y2K Style, Old Money..."
                       class="w-full bg-neutral-50 border border-neutral-200 rounded-xl px-5 py-3 text-neutral-900 font-medium focus:bg-white focus:ring-2 focus:ring-neutral-900 focus:outline-none transition">
            </div>

            {{-- DESKRIPSI --}}
            <div class="group">
                <label class="block text-sm font-bold text-neutral-900 mb-2">Deskripsi</label>
                <textarea name="description" rows="4" placeholder="Jelaskan detail trend ini..."
                          class="w-full bg-neutral-50 border border-neutral-200 rounded-xl px-5 py-3 text-neutral-900 font-medium focus:bg-white focus:ring-2 focus:ring-neutral-900 focus:outline-none transition"></textarea>
            </div>

            {{-- GAMBAR --}}
            <div class="group">
                <label class="block text-sm font-bold text-neutral-900 mb-2">Cover Image</label>
                <input type="file" name="image"
                       class="w-full border border-dashed border-neutral-300 p-4 rounded-xl bg-neutral-50 text-sm text-neutral-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-neutral-900 file:text-white hover:file:bg-neutral-700 cursor-pointer">
            </div>

            {{-- ACTION --}}
            <div class="flex justify-end gap-3 pt-6 border-t border-neutral-100">
                <a href="{{ route('admin.trends.index') }}"
                   class="px-6 py-3 rounded-xl border border-neutral-200 text-neutral-600 font-bold text-sm hover:bg-neutral-50 transition">
                    Batal
                </a>

                <button type="submit"
                        class="bg-neutral-900 hover:bg-neutral-800 text-white px-8 py-3 rounded-xl font-bold text-sm shadow-lg transition transform hover:scale-[1.02]">
                    Simpan Trend
                </button>
            </div>

        </form>
    </div>

@endsection