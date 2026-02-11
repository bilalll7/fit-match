@extends('admin.layouts.app')

@section('content')

    {{-- HEADER SECTION --}}
    <div class="mb-8">
        <h1 class="text-3xl font-black text-neutral-900 tracking-tight">Edit Style</h1>
        <p class="text-neutral-500 mt-1 text-sm">Perbarui informasi dan tampilan style di sini.</p>
    </div>

    {{-- FORM CARD --}}
    <div class="bg-white p-8 rounded-3xl border border-neutral-100 shadow-[0_4px_20px_rgb(0,0,0,0.03)] max-w-2xl">
        
        <form
            method="POST"
            action="{{ route('admin.styles.update', $style) }}"
            enctype="multipart/form-data"
            x-data="{ loading: false }"
            @submit.prevent="
                loading = true;
                $el.submit();
            "
            class="space-y-6"
        >
            @csrf
            @method('PUT')

            {{-- Input Nama --}}
            <div class="group">
                <label class="block text-sm font-bold text-neutral-900 mb-2">
                    Nama Style
                </label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $style->name) }}"
                    required
                    placeholder="Contoh: Streetwear, Casual..."
                    class="w-full bg-neutral-50 border border-neutral-200 rounded-xl px-5 py-3 
                           text-neutral-900 font-medium focus:bg-white focus:ring-2 focus:ring-neutral-900 focus:border-transparent 
                           transition duration-200 outline-none placeholder:text-neutral-400">
            </div>

            {{-- Input Deskripsi --}}
            <div class="group">
                <label class="block text-sm font-bold text-neutral-900 mb-2">
                    Deskripsi
                </label>
                <textarea
                    name="description"
                    rows="4"
                    required
                    placeholder="Jelaskan detail style ini..."
                    class="w-full bg-neutral-50 border border-neutral-200 rounded-xl px-5 py-3 
                           text-neutral-900 font-medium focus:bg-white focus:ring-2 focus:ring-neutral-900 focus:border-transparent 
                           transition duration-200 outline-none placeholder:text-neutral-400 resize-none">{{ old('description', $style->description) }}</textarea>
            </div>

            {{-- Input Gambar --}}
            <div>
                <label class="block text-sm font-bold text-neutral-900 mb-2">
                    Gambar Thumbnail
                </label>
                
                <div class="flex flex-col sm:flex-row items-start gap-6 p-4 border border-dashed border-neutral-300 rounded-xl bg-neutral-50">
                    {{-- Preview Gambar Lama --}}
                    <div class="relative shrink-0">
                        <p class="text-xs font-semibold text-neutral-500 mb-2 text-center">Saat Ini</p>
                        <img
                            src="{{ asset('storage/'.$style->image) }}"
                            class="w-32 h-32 object-cover rounded-xl shadow-sm border border-neutral-200 bg-white"
                            alt="Current Image">
                    </div>

                    {{-- Upload Baru --}}
                    <div class="w-full">
                        <p class="text-xs font-semibold text-neutral-500 mb-2">Ganti Gambar (Opsional)</p>
                        <input
                            type="file"
                            name="image"
                            class="block w-full text-sm text-neutral-500
                                   file:mr-4 file:py-2.5 file:px-4
                                   file:rounded-lg file:border-0
                                   file:text-xs file:font-bold
                                   file:bg-neutral-900 file:text-white
                                   hover:file:bg-neutral-700
                                   cursor-pointer bg-white border border-neutral-200 rounded-lg">
                        <p class="text-xs text-neutral-400 mt-2">Format: JPG, PNG, JPEG. Max: 2MB.</p>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-4 pt-4 border-t border-neutral-100">
                
                {{-- Tombol Update (Hitam) --}}
                <button
                    type="submit"
                    :disabled="loading"
                    class="bg-neutral-900 hover:bg-neutral-800 text-white px-8 py-3 rounded-xl font-bold text-sm 
                           transition transform hover:scale-[1.02] active:scale-95 disabled:opacity-70 disabled:cursor-not-allowed shadow-lg">
                    <span x-show="!loading">Simpan Perubahan</span>
                    <span x-show="loading" class="flex items-center gap-2">
                        <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Menyimpan...
                    </span>
                </button>

                {{-- Tombol Batal (Putih/Outline) --}}
                <a href="{{ route('admin.styles.index') }}"
                   class="bg-white border border-neutral-200 text-neutral-600 hover:text-neutral-900 hover:bg-neutral-50 
                          px-8 py-3 rounded-xl font-bold text-sm transition text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>

    {{-- Library Pendukung (Jika belum ada di Layout Utama) --}}
    @push('scripts')
        <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        {{-- Kita hapus SweetAlert di sini karena sudah handle loading pakai Alpine & CSS murni biar lebih clean --}}
    @endpush

@endsection