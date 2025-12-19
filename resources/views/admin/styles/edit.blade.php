@extends('admin.layouts.app')

@section('content')

{{-- FONT + SWEETALERT + ALPINE (SATU FILE) --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    * { font-family: 'Poppins', sans-serif; }
</style>

<h1 class="text-2xl font-semibold mb-6 text-gray-700">
    Edit Style
</h1>

<form
    method="POST"
    action="{{ route('admin.styles.update', $style) }}"
    enctype="multipart/form-data"
    x-data="{ loading: false }"
    @submit.prevent="
        loading = true;
        Swal.fire({
            title: 'Memperbarui...',
            text: 'Mohon tunggu',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });
        $el.submit();
    "
    class="bg-white p-6 rounded-xl shadow max-w-xl space-y-4"
>
    @csrf
    @method('PUT')

    <div>
        <label class="block text-sm font-medium mb-1 text-gray-600">
            Nama Style
        </label>
        <input
            type="text"
            name="name"
            value="{{ old('name', $style->name) }}"
            required
            class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none">
    </div>

    <div>
        <label class="block text-sm font-medium mb-1 text-gray-600">
            Deskripsi
        </label>
        <textarea
            name="description"
            rows="4"
            required
            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none">{{ old('description', $style->description) }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium mb-1 text-gray-600">
            Gambar
        </label>
        <input
            type="file"
            name="image"
            class="w-full border rounded-lg px-4 py-2">
        <img
            src="{{ asset('storage/'.$style->image) }}"
            class="w-32 mt-3 rounded-lg shadow">
    </div>

    <div class="flex gap-4 pt-2">
        <button
            type="submit"
            :disabled="loading"
            class="bg-green-600 hover:bg-green-700 transition
                   text-white px-6 py-2 rounded-lg
                   active:scale-95
                   disabled:opacity-60
                   disabled:cursor-not-allowed">
            <span x-show="!loading">Update</span>
            <span x-show="loading">Memperbarui...</span>
        </button>

        <a href="{{ route('admin.styles.index') }}"
           class="px-6 py-2 border rounded-lg
                  hover:bg-gray-50 transition">
            Batal
        </a>
    </div>
</form>

@endsection