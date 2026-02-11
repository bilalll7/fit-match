@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-16 min-h-screen">

    {{-- HEADER SECTION --}}
    <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
        <div>
            <h1 class="text-4xl font-bold tracking-tight text-neutral-900 mb-3">Your Collection</h1>
            <p class="text-neutral-500 max-w-lg leading-relaxed">
                Kelola lemari digitalmu. Tambahkan item baru untuk mulai mix-and-match gayamu sendiri.
            </p>
        </div>

        <button onclick="openModal('addModal')" 
            class="group flex items-center gap-3 bg-neutral-900 text-white px-6 py-3 rounded-xl hover:bg-black transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1">
            <span class="font-medium">+ New Item</span>
        </button>
    </div>

    {{-- CATEGORY TABS --}}
    <div class="flex gap-2 overflow-x-auto pb-4 mb-10 scrollbar-hide">
        {{-- ALL --}}
        <a href="{{ route('outfits.index') }}" 
           class="px-6 py-2.5 rounded-full text-sm font-medium transition-all whitespace-nowrap border
           {{ !request('category') 
               ? 'bg-neutral-900 text-white border-neutral-900' 
               : 'bg-white text-neutral-500 border-neutral-200 hover:border-neutral-900 hover:text-neutral-900' }}">
            All Items
        </a>

        {{-- DYNAMIC CATEGORIES --}}
        @foreach($categories as $category)
            <a href="{{ route('outfits.index', ['category' => $category->id]) }}" 
               class="px-6 py-2.5 rounded-full text-sm font-medium transition-all whitespace-nowrap border
               {{ request('category') == $category->id 
                   ? 'bg-neutral-900 text-white border-neutral-900' 
                   : 'bg-white text-neutral-500 border-neutral-200 hover:border-neutral-900 hover:text-neutral-900' }}">
                {{ $category->name }}
            </a>
        @endforeach
    </div>

    {{-- GRID SECTION --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        @forelse($outfits as $outfit)
            <div class="group relative bg-white rounded-2xl border border-neutral-100 overflow-hidden hover:shadow-2xl hover:shadow-neutral-200/50 transition-all duration-500">
                
                {{-- Image --}}
                <div class="relative aspect-[3/4] overflow-hidden bg-neutral-50">
                    <img src="{{ asset('storage/'.$outfit->image) }}" 
                         alt="{{ $outfit->name }}"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    
                    {{-- Overlay Actions (Edit/Delete) --}}
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-3">
                        {{-- Edit Button --}}
                        <button onclick="openEditModal({{ $outfit }})" 
                                class="w-10 h-10 rounded-full bg-white text-neutral-900 flex items-center justify-center hover:bg-neutral-200 transition-colors"
                                title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </button>
                        
                        {{-- Delete Button --}}
                        <button onclick="confirmDelete({{ $outfit->id }})" 
                                class="w-10 h-10 rounded-full bg-white text-red-500 flex items-center justify-center hover:bg-red-50 transition-colors"
                                title="Delete">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </div>

                    {{-- Category Tag --}}
                    <div class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur-sm rounded-lg text-xs font-bold uppercase tracking-wider text-neutral-900 shadow-sm">
                        {{ $outfit->category->name }}
                    </div>
                </div>

                {{-- Info --}}
                <div class="p-5">
                    <h3 class="font-bold text-neutral-900 text-lg truncate">{{ $outfit->name }}</h3>
                    <p class="text-sm text-neutral-500 mt-1">Added {{ $outfit->created_at->diffForHumans() }}</p>
                </div>
            </div>
            
            {{-- Hidden Delete Form --}}
            <form id="delete-form-{{ $outfit->id }}" action="{{ route('outfits.destroy', $outfit) }}" method="POST" class="hidden">
                @csrf @method('DELETE')
            </form>

        @empty
            <div class="col-span-full flex flex-col items-center justify-center py-24 text-center border-2 border-dashed border-neutral-200 rounded-3xl bg-neutral-50/50">
                <div class="w-16 h-16 bg-neutral-200 rounded-full flex items-center justify-center mb-4 text-neutral-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-neutral-900">Belum ada koleksi</h3>
                <p class="text-neutral-500 mt-2 max-w-xs mx-auto">Mulai tambahkan outfit favoritmu untuk mendapatkan rekomendasi gaya.</p>
                <button onclick="openModal('addModal')" class="mt-6 text-sm font-semibold text-neutral-900 underline hover:text-black">
                    Tambah Item Pertama
                </button>
            </div>
        @endforelse
    </div>
</div>

{{-- ================= MODALS SECTION ================= --}}

{{-- 1. ADD OUTFIT MODAL --}}
<div id="addModal" class="fixed inset-0 z-50 hidden">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-neutral-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal('addModal')"></div>
    
    {{-- Content --}}
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl p-8 animate-fade-in-up">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-neutral-900">Add New Outfit</h2>
                <button onclick="closeModal('addModal')" class="text-neutral-400 hover:text-neutral-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form action="{{ route('outfits.store') }}" method="POST" enctype="multipart/form-data" id="addForm">
                @csrf
                <div class="space-y-5">
                    {{-- Name Input --}}
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-neutral-500 mb-2">Outfit Name</label>
                        <input type="text" name="name" required placeholder="e.g. Black Oversized Tee" 
                            class="w-full bg-neutral-50 border border-neutral-200 rounded-xl px-4 py-3 text-neutral-900 placeholder:text-neutral-400 focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:bg-white transition-all">
                    </div>

                    {{-- Category Input --}}
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-neutral-500 mb-2">Category</label>
                        <select name="category_id" required
                            class="w-full bg-neutral-50 border border-neutral-200 rounded-xl px-4 py-3 text-neutral-900 focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:bg-white transition-all appearance-none">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Modern File Input --}}
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-neutral-500 mb-2">Photo</label>
                        <div class="relative group">
                            <input type="file" name="image" id="addImage" required accept="image/*" 
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                                onchange="previewImage(this, 'addPreview')">
                            
                            <div class="border-2 border-dashed border-neutral-300 rounded-xl p-8 flex flex-col items-center justify-center text-center group-hover:border-neutral-900 group-hover:bg-neutral-50 transition-all" id="addPreviewBox">
                                <div id="addPreviewPlaceholder">
                                    <div class="w-10 h-10 bg-neutral-100 rounded-full flex items-center justify-center text-neutral-400 mb-3 mx-auto">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <p class="text-sm font-medium text-neutral-900">Click to upload or drag and drop</p>
                                    <p class="text-xs text-neutral-500 mt-1">SVG, PNG, JPG (Max. 2MB)</p>
                                </div>
                                <img id="addPreview" class="hidden h-40 object-contain rounded-lg shadow-sm" src="#" alt="Preview" />
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-neutral-900 text-white font-bold py-4 rounded-xl hover:bg-black transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                        Save to Collection
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- 2. EDIT OUTFIT MODAL --}}
<div id="editModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-neutral-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal('editModal')"></div>
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl p-8 animate-fade-in-up">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-neutral-900">Edit Outfit</h2>
                <button onclick="closeModal('editModal')" class="text-neutral-400 hover:text-neutral-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" id="editForm">
                @csrf @method('PUT')
                <div class="space-y-5">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-neutral-500 mb-2">Outfit Name</label>
                        <input type="text" name="name" id="editName" required
                            class="w-full bg-neutral-50 border border-neutral-200 rounded-xl px-4 py-3 text-neutral-900 focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:bg-white transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-neutral-500 mb-2">Category</label>
                        <select name="category_id" id="editCategory" required
                            class="w-full bg-neutral-50 border border-neutral-200 rounded-xl px-4 py-3 text-neutral-900 focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:bg-white transition-all appearance-none">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-neutral-500 mb-2">Change Photo (Optional)</label>
                        <div class="relative group">
                            <input type="file" name="image" id="editImage" accept="image/*" 
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                                onchange="previewImage(this, 'editPreview')">
                            
                            <div class="border-2 border-dashed border-neutral-300 rounded-xl p-4 flex flex-col items-center justify-center text-center group-hover:border-neutral-900 group-hover:bg-neutral-50 transition-all">
                                <img id="editPreview" class="h-32 object-contain rounded-lg shadow-sm mb-3" src="#" alt="Preview" />
                                <p class="text-xs text-neutral-500">Click to change photo</p>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-neutral-900 text-white font-bold py-4 rounded-xl hover:bg-black transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                        Update Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // --- MODAL FUNCTIONS ---
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Disable scroll
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
        document.body.style.overflow = 'auto'; // Enable scroll
    }

    // --- EDIT LOGIC ---
    function openEditModal(outfit) {
        // 1. Populate Input Values
        document.getElementById('editName').value = outfit.name;
        document.getElementById('editCategory').value = outfit.category_id;
        
        // 2. Set Image Preview
        const previewImg = document.getElementById('editPreview');
        previewImg.src = "/storage/" + outfit.image;
        
        // 3. Set Form Action URL Dynamically
        const form = document.getElementById('editForm');
        // Ganti URL ini sesuai dengan route update kamu. 
        // Biasanya: /outfits/{id}
        form.action = "/outfits/" + outfit.id;

        // 4. Open Modal
        openModal('editModal');
    }

    // --- IMAGE PREVIEW FUNCTION ---
    function previewImage(input, imgId) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById(imgId);
                img.src = e.target.result;
                img.classList.remove('hidden');
                
                // Hide placeholder text specifically for Add Modal
                if(imgId === 'addPreview') {
                    document.getElementById('addPreviewPlaceholder').classList.add('hidden');
                }
            }
            reader.readAsDataURL(file);
        }
    }

    // --- SWEETALERT (DELETE) ---
    function confirmDelete(id) {
        Swal.fire({
            title: 'Hapus Item?',
            text: "Item ini akan dihapus permanen dari lemari digitalmu.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#171717', // Neutral-900
            cancelButtonColor: '#d4d4d4', // Neutral-300
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            color: '#171717',
            background: '#ffffff',
            customClass: {
                popup: 'rounded-2xl',
                confirmButton: 'rounded-xl',
                cancelButton: 'rounded-xl text-neutral-700'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }

    // --- SWEETALERT (SUCCESS MESSAGE) ---
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false,
            confirmButtonColor: '#171717',
             customClass: {
                popup: 'rounded-2xl'
            }
        });
    @endif
</script>
@endpush