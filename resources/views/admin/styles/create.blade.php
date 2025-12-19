@extends('admin.layouts.app')

@section('content')

{{-- FONT + SWEETALERT + ALPINE --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<style>
    * { font-family: 'Poppins', sans-serif; }
</style>

{{-- HEADER --}}
<div class="mb-8">
    <h1 class="text-3xl font-bold text-emerald-600">
        Tambah Style
    </h1>
    <p class="text-gray-500 text-sm">
        Tambahkan style baru untuk rekomendasi outfit FitMatch
    </p>
</div>

{{-- CARD --}}
<form
    method="POST"
    action="{{ route('admin.styles.store') }}"
    enctype="multipart/form-data"
    x-data="{ loading: false }"
    @submit.prevent="
        loading = true;
        Swal.fire({
            title: 'Menyimpan Data',
            text: 'Mohon tunggu sebentar...',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });
        $el.submit();
    "
    class="max-w-4xl bg-white rounded-3xl shadow-xl p-8 space-y-6"
>
    @csrf

    {{-- NAMA STYLE --}}
    <div>
        <label class="block text-sm font-semibold text-gray-600 mb-2">
            Nama Style
        </label>
        <input
            type="text"
            name="name"
            required
            placeholder="Contoh: Streetwear, Casual, Formal"
            class="w-full px-4 py-3 rounded-xl
                   border border-gray-200
                   focus:outline-none
                   focus:ring-4 focus:ring-emerald-200
                   transition"
        >
    </div>

    {{-- DESKRIPSI --}}
    <div>
        <label class="block text-sm font-semibold text-gray-600 mb-2">
            Deskripsi Style
        </label>
        <textarea
            name="description"
            rows="4"
            required
            placeholder="Deskripsikan karakter style ini..."
            class="w-full px-4 py-3 rounded-xl
                   border border-gray-200
                   focus:outline-none
                   focus:ring-4 focus:ring-emerald-200
                   transition"></textarea>
    </div>

    {{-- UPLOAD GAMBAR --}}
    <div>
        <label class="block text-sm font-semibold text-gray-600 mb-2">
            Gambar Style
        </label>
        <input
            type="file"
            name="image"
            class="w-full px-4 py-3 rounded-xl
                   border border-gray-200
                   bg-gray-50
                   focus:outline-none"
        >
    </div>

    {{-- STATUS --}}
    <div class="flex items-center gap-3">
        <input
            type="checkbox"
            name="is_active"
            checked
            class="w-5 h-5 accent-emerald-500"
        >
        <span class="text-sm text-gray-600">
            Aktifkan style ini
        </span>
    </div>

    {{-- ACTION --}}
    <div class="flex justify-end gap-4 pt-4">
        <a
            href="{{ route('admin.styles.index') }}"
            class="px-6 py-3 rounded-xl
                   border border-gray-300
                   text-gray-600
                   hover:bg-gray-100 transition"
        >
            Batal
        </a>

        <button
            type="submit"
            :disabled="loading"
            class="px-8 py-3 rounded-xl text-white font-semibold
                   bg-gradient-to-r from-emerald-400 to-green-500
                   hover:from-emerald-500 hover:to-green-600
                   shadow-lg hover:shadow-xl
                   transition
                   disabled:opacity-60
                   disabled:cursor-not-allowed"
        >
            <span x-show="!loading">Simpan Style</span>
            <span x-show="loading">Menyimpan...</span>
        </button>
    </div>

</form>

@endsection