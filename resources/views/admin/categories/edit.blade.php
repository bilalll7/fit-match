@extends('admin.layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    * { font-family: 'Poppins', sans-serif; }
</style>

@if (session('success'))
<script>
document.addEventListener('DOMContentLoaded', () => {
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        timer: 2500,
        showConfirmButton: false,
        showClass: { popup: 'animate_animated animate_zoomIn' },
        hideClass: { popup: 'animate_animated animate_zoomOut' }
    });
});
</script>
@endif

<h1 class="text-2xl font-semibold mb-6 text-gray-700">
    Edit Kategori
</h1>

<form
    method="POST"
    action="{{ route('admin.categories.update', $category) }}"
    x-data="{ loading: false }"
    @submit.prevent="
        loading = true;
        Swal.fire({
            title: 'Memperbarui Kategori',
            text: 'Mohon tunggu...',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });
        $el.submit();
    "
    class="bg-white rounded-3xl shadow-xl p-8 max-w-lg space-y-6"
>
    @csrf
    @method('PUT')

    <div>
        <label class="block text-sm font-medium text-gray-600 mb-1">
            Nama Kategori
        </label>
        <input
            type="text"
            name="name"
            value="{{ old('name', $category->name) }}"
            required
            class="w-full border rounded-xl px-4 py-3
                   focus:ring-2 focus:ring-green-400 focus:outline-none transition">
    </div>
    <div>
    <label class="block text-sm font-medium text-gray-600 mb-1">
        Role Pakaian
    </label>

    <select name="role"
            class="w-full border rounded-xl px-4 py-3">
        <option value="top" {{ $category->role == 'top' ? 'selected' : '' }}>Atasan</option>
        <option value="bottom" {{ $category->role == 'bottom' ? 'selected' : '' }}>Bawahan</option>
        <option value="outer" {{ $category->role == 'outer' ? 'selected' : '' }}>Outer</option>
        <option value="shoes" {{ $category->role == 'shoes' ? 'selected' : '' }}>Sepatu</option>
        <option value="accessory" {{ $category->role == 'accessory' ? 'selected' : '' }}>Aksesoris</option>
    </select>
</div>

    <div class="flex items-center gap-3">
        <input
            type="checkbox"
            name="is_active"
            {{ $category->is_active ? 'checked' : '' }}
            class="accent-green-600">
        <span class="text-sm text-gray-600">
            Aktifkan kategori
        </span>
    </div>

    <div class="flex gap-4 pt-2">
        <button
            type="submit"
            :disabled="loading"
            class="bg-green-600 hover:bg-green-700 transition
                   text-white px-6 py-3 rounded-xl font-medium
                   active:scale-95
                   disabled:opacity-60 disabled:cursor-not-allowed">
            <span x-show="!loading">Update</span>
            <span x-show="loading">Memperbarui...</span>
        </button>

        <a href="{{ route('admin.categories.index') }}"
           class="px-6 py-3 border rounded-xl hover:bg-gray-50 transition">
            Batal
        </a>
    </div>
</form>

@endsection