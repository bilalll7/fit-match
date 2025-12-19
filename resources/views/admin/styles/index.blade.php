@extends('admin.layouts.app')

@section('content')

{{-- FONT POPPINS + ALPINE --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<style>
    * {
        font-family: 'Poppins', sans-serif;
    }
</style>

{{-- ALERT ANIMASI --}}
@if (session('success'))
<div
    x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 3000)"
    x-show="show"
    x-transition.opacity.duration.500ms
    class="mb-6 rounded-lg bg-green-100 border border-green-300 text-green-700 px-4 py-3 shadow">
    {{ session('success') }}
</div>
@endif

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold text-gray-700">
        Eksplorasi Gaya
    </h1>

    <a href="{{ route('admin.styles.create') }}"
       class="bg-green-500 hover:bg-green-600 transition text-white px-5 py-2 rounded-lg shadow">
        + Tambah Style
    </a>
</div>

<div class="overflow-x-auto">
<table class="w-full bg-white rounded-xl shadow">
    <thead class="bg-gray-50 text-gray-600 text-sm">
        <tr>
            <th class="p-4 text-left">Nama</th>
            <th class="p-4 text-left">Deskripsi</th>
            <th class="p-4 text-center">Gambar</th>
            <th class="p-4 text-center">Status</th>
            <th class="p-4 text-center">Aksi</th>
        </tr>
    </thead>

    <tbody class="text-gray-700 text-sm">
        @foreach($styles as $style)
        <tr class="border-t hover:bg-gray-50 transition">
            <td class="p-4 font-medium">
                {{ $style->name }}
            </td>

            <td class="p-4 text-gray-500">
                {{ Str::limit($style->description, 80) }}
            </td>

            <td class="p-4 flex justify-center">
                <img
                    src="{{ asset('storage/' . $style->image) }}"
                    class="w-20 h-24 object-cover rounded-lg shadow">
            </td>

            <td class="p-4 text-center">
                <form action="{{ route('admin.styles.toggle', $style) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button
                        class="px-4 py-1.5 rounded-full text-white text-xs font-medium transition
                        {{ $style->is_active ? 'bg-green-500 hover:bg-green-600' : 'bg-gray-400 hover:bg-gray-500' }}">
                        {{ $style->is_active ? 'Aktif' : 'Nonaktif' }}
                    </button>
                </form>
            </td>

            <td class="p-4 text-center">
                <div class="flex justify-center gap-4">
                    <a href="{{ route('admin.styles.edit', $style) }}"
                       class="text-blue-500 hover:underline">
                        Edit
                    </a>

                    <form
    method="POST"
    action="{{ route('admin.styles.destroy', $style) }}"
    x-data="{ loading: false }"
    @submit.prevent="
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Data ini tidak bisa dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#9ca3af',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal',
            showClass: {
                popup: 'animate_animated animate_zoomIn'
            },
            hideClass: {
                popup: 'animate_animated animate_zoomOut'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                loading = true;
                Swal.fire({
                    title: 'Menghapus...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });
                $el.submit();
            }
        });
    "
>
    @csrf
    @method('DELETE')

    {{-- CDN (cukup sekali, aman walau di sini) --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <button
        type="submit"
        :disabled="loading"
        class="text-red-500 font-medium transition
               hover:text-red-600
               active:scale-95
               disabled:opacity-60
               disabled:cursor-not-allowed">
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
</div>

@endsection