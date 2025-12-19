@extends('admin.layouts.app')

@section('content')

{{-- HEADER --}}
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-bold text-emerald-600">
            Tambah kategori
        </h1>
        
    </div>

    {{-- BADGE --}}
    <span class="px-4 py-2 rounded-full text-sm font-medium
                 bg-emerald-100 text-emerald-600">
        Admin FitMatch
    </span>
</div>

{{-- GRID AGAR TIDAK KOSONG --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

   {{-- FORM KATEGORI + SWEETALERT --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<style>
    * { font-family: 'Poppins', sans-serif; }
</style>

{{-- ALERT SUCCESS (SETELAH REDIRECT) --}}
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
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endif

<form
    method="POST"
    action="{{ route('admin.categories.store') }}"
    x-data="{ loading: false }"
    @submit.prevent="
        loading = true;
        Swal.fire({
            title: 'Menyimpan Kategori',
            text: 'Mohon tunggu...',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });
        $el.submit();
    "
    class="lg:col-span-2 bg-white rounded-3xl shadow-xl p-8 space-y-6"
>
    @csrf

    <div>
        <label class="block text-sm font-medium text-gray-600 mb-1">
            Nama Kategori
        </label>
        <input
            name="name"
            required
            placeholder="Masukkan nama kategori"
            class="w-full border rounded-xl px-4 py-3
                   focus:ring-2 focus:ring-green-400 focus:outline-none transition">
    </div>
<div>
    <label class="block text-sm font-medium text-gray-600 mb-1">
        Role Pakaian
    </label>

    <select name="role"
            required
            class="w-full border rounded-xl px-4 py-3">
        <option value="">-- Pilih Role --</option>
        <option value="top">Atasan</option>
        <option value="bottom">Bawahan</option>
        <option value="outer">Outer</option>
        <option value="shoes">Sepatu</option>
        <option value="accessory">Aksesoris</option>
    </select>
</div>

    <button
        type="submit"
        :disabled="loading"
        class="w-full bg-green-600 hover:bg-green-700 transition
               text-white px-6 py-3 rounded-xl font-medium
               active:scale-95
               disabled:opacity-60 disabled:cursor-not-allowed"
    >
        <span x-show="!loading">Simpan</span>
        <span x-show="loading">Menyimpan...</span>
    </button>
</form>


        

       

       
        
    </form>

    

@endsection