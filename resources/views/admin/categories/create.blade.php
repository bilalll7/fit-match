@extends('admin.layouts.app')

@section('content')

    {{-- HEADER --}}
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-neutral-900 tracking-tight">Tambah Kategori</h1>
            <p class="text-neutral-500 mt-1 text-sm">Buat kategori baru untuk mengelompokkan outfit.</p>
        </div>
        
        <span class="px-4 py-2 rounded-full text-xs font-bold tracking-widest uppercase
                     bg-neutral-100 text-neutral-600 border border-neutral-200">
            Admin Area
        </span>
    </div>

    {{-- FORM CARD --}}
    <div class="bg-white p-8 rounded-3xl border border-neutral-100 shadow-[0_4px_20px_rgb(0,0,0,0.03)] max-w-2xl">

        {{-- LIBRARY PENDUKUNG --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

        <form
            method="POST"
            action="{{ route('admin.categories.store') }}"
            x-data="{ loading: false }"
            @submit.prevent="
                loading = true;
                $el.submit();
            "
            class="space-y-6"
        >
            @csrf

            {{-- Nama Kategori --}}
            <div class="group">
                <label class="block text-sm font-bold text-neutral-900 mb-2">
                    Nama Kategori
                </label>
                <input
                    name="name"
                    required
                    placeholder="Contoh: Casual, Formal, Sporty"
                    class="w-full bg-neutral-50 border border-neutral-200 rounded-xl px-5 py-3 
                           text-neutral-900 font-medium focus:bg-white focus:ring-2 focus:ring-neutral-900 focus:border-transparent 
                           transition duration-200 outline-none placeholder:text-neutral-400">
            </div>

            {{-- Role Pakaian --}}
            <div class="group">
                <label class="block text-sm font-bold text-neutral-900 mb-2">
                    Role Pakaian
                </label>
                <div class="relative">
                    <select name="role"
                            required
                            class="w-full bg-neutral-50 border border-neutral-200 rounded-xl px-5 py-3 
                                   text-neutral-900 font-medium focus:bg-white focus:ring-2 focus:ring-neutral-900 focus:border-transparent 
                                   transition duration-200 outline-none appearance-none cursor-pointer">
                        <option value="">-- Pilih Posisi --</option>
                        <option value="top">Atasan (Top)</option>
                        <option value="bottom">Bawahan (Bottom)</option>
                        <option value="outer">Outerwear</option>
                        <option value="shoes">Sepatu (Shoes)</option>
                        <option value="accessory">Aksesoris</option>
                    </select>
                    {{-- Chevron Icon --}}
                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-neutral-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-4 pt-4 border-t border-neutral-100">
                <button
                    type="submit"
                    :disabled="loading"
                    class="flex-1 bg-neutral-900 hover:bg-neutral-800 text-white px-6 py-3 rounded-xl font-bold text-sm 
                           transition transform hover:scale-[1.02] active:scale-95 disabled:opacity-70 disabled:cursor-not-allowed shadow-lg">
                    <span x-show="!loading">Simpan Data</span>
                    <span x-show="loading" class="flex justify-center items-center gap-2">
                        <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Menyimpan...
                    </span>
                </button>

                <a href="{{ route('admin.categories.index') }}"
                   class="px-6 py-3 border border-neutral-200 rounded-xl font-bold text-sm text-neutral-600 hover:bg-neutral-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>

@endsection