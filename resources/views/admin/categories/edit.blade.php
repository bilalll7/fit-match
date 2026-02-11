@extends('admin.layouts.app')

@section('content')

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-3xl font-black text-neutral-900 tracking-tight">Edit Kategori</h1>
        <p class="text-neutral-500 mt-1 text-sm">Perbarui detail kategori.</p>
    </div>

    {{-- FORM CARD --}}
    <div class="bg-white p-8 rounded-3xl border border-neutral-100 shadow-[0_4px_20px_rgb(0,0,0,0.03)] max-w-2xl">

        {{-- SCRIPTS --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

        <form
            method="POST"
            action="{{ route('admin.categories.update', $category) }}"
            x-data="{ loading: false }"
            @submit.prevent="loading = true; $el.submit();"
            class="space-y-6"
        >
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div class="group">
                <label class="block text-sm font-bold text-neutral-900 mb-2">Nama Kategori</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $category->name) }}"
                    required
                    class="w-full bg-neutral-50 border border-neutral-200 rounded-xl px-5 py-3 
                           text-neutral-900 font-medium focus:bg-white focus:ring-2 focus:ring-neutral-900 focus:border-transparent 
                           transition duration-200 outline-none">
            </div>

            {{-- Role --}}
            <div class="group">
                <label class="block text-sm font-bold text-neutral-900 mb-2">Role Pakaian</label>
                <div class="relative">
                    <select name="role"
                            class="w-full bg-neutral-50 border border-neutral-200 rounded-xl px-5 py-3 
                                   text-neutral-900 font-medium focus:bg-white focus:ring-2 focus:ring-neutral-900 focus:border-transparent 
                                   transition duration-200 outline-none appearance-none cursor-pointer">
                        <option value="top" {{ $category->role == 'top' ? 'selected' : '' }}>Atasan</option>
                        <option value="bottom" {{ $category->role == 'bottom' ? 'selected' : '' }}>Bawahan</option>
                        <option value="outer" {{ $category->role == 'outer' ? 'selected' : '' }}>Outer</option>
                        <option value="shoes" {{ $category->role == 'shoes' ? 'selected' : '' }}>Sepatu</option>
                        <option value="accessory" {{ $category->role == 'accessory' ? 'selected' : '' }}>Aksesoris</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-neutral-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
            </div>

            {{-- Checkbox Active --}}
            <div class="flex items-center gap-3 bg-neutral-50 p-4 rounded-xl border border-neutral-100">
                <input
                    type="checkbox"
                    name="is_active"
                    id="is_active"
                    {{ $category->is_active ? 'checked' : '' }}
                    class="w-5 h-5 rounded border-gray-300 text-neutral-900 focus:ring-neutral-900 accent-neutral-900 cursor-pointer">
                <label for="is_active" class="text-sm font-semibold text-neutral-700 cursor-pointer select-none">
                    Status Aktif (Tampilkan di Aplikasi)
                </label>
            </div>

            {{-- Buttons --}}
            <div class="flex gap-4 pt-4 border-t border-neutral-100">
                <button type="submit" :disabled="loading"
                    class="flex-1 bg-neutral-900 hover:bg-neutral-800 text-white px-6 py-3 rounded-xl font-bold text-sm 
                           transition shadow-lg disabled:opacity-70">
                    <span x-show="!loading">Update Perubahan</span>
                    <span x-show="loading">Memproses...</span>
                </button>

                <a href="{{ route('admin.categories.index') }}"
                   class="px-6 py-3 border border-neutral-200 rounded-xl font-bold text-sm text-neutral-600 hover:bg-neutral-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>

@endsection