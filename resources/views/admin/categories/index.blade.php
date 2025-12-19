@extends('admin.layouts.app')

@section('content')

{{-- FONT + SWEETALERT + ALPINE --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    * { font-family: 'Poppins', sans-serif; }
</style>

{{-- ALERT SUCCESS (DARI CONTROLLER) --}}
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

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold text-gray-700">
        Kategori Outfit
    </h1>

    <a href="{{ route('admin.categories.create') }}"
       class="bg-green-600 hover:bg-green-700 transition
              text-white px-5 py-2 rounded-lg shadow">
        + Tambah Kategori
    </a>
</div>

<table class="w-full bg-white rounded-xl shadow">
<thead class="bg-gray-50 text-gray-600 text-sm">
    <tr>
        <th class="p-4 text-left">Nama</th>
        <th class="p-4 text-center">Role</th>
        <th class="p-4 text-center">Status</th>
        <th class="p-4 text-center">Aksi</th>
    </tr>
</thead>



    <tbody class="text-gray-700 text-sm">
        @foreach($categories as $category)
       <tr class="border-t hover:bg-gray-50 transition">
    <td class="p-4 font-medium">
        {{ $category->name }}
    </td>

    {{-- ROLE --}}
    <td class="p-4 text-center">
        <span class="px-3 py-1 rounded-full text-xs font-medium
            bg-blue-100 text-blue-700">
            {{ ucfirst($category->role) }}
        </span>
    </td>

    {{-- STATUS --}}
    <td class="p-4 text-center">
        <span class="px-3 py-1 rounded-full text-xs font-medium
            {{ $category->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
            {{ $category->is_active ? 'Aktif' : 'Nonaktif' }}
        </span>
    </td>

    {{-- AKSI --}}
    <td class="p-4 text-center">
        <div class="flex justify-center gap-4">

            <a href="{{ route('admin.categories.edit', $category) }}"
               class="text-blue-500 hover:underline">
                Edit
            </a>

            <form
                method="POST"
                action="{{ route('admin.categories.destroy', $category) }}"
                x-data="{ loading: false }"
                @submit.prevent="
                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: 'Kategori ini akan dihapus permanen!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#9ca3af',
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            loading = true;
                            Swal.fire({
                                title: 'Menghapus...',
                                allowOutsideClick: false,
                                didOpen: () => Swal.showLoading()
                            });
                            $el.submit();
                        }
                    });
                "
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    :disabled="loading"
                    class="text-red-500 hover:text-red-600 transition
                           disabled:opacity-60">
                    <span x-show="!loading">Hapus</span>
                    <span x-show="loading">Menghapus...</span>
                </button>
            </form>

        </div>
    </td>
</tr>

        @endforeach
    </tbody>
</table>

@endsection