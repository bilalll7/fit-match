<section class="py-24 bg-neutral-50 border-t border-neutral-200">
    <div class="max-w-7xl mx-auto px-6">

        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold tracking-tight text-neutral-900 mb-2">
                    Style Archives.
                </h2>
                <p class="text-neutral-500">
                    Eksplorasi referensi gaya visual terkini.
                </p>
            </div>
            
            {{-- DESKTOP BUTTON --}}
            {{-- Hanya muncul jika item lebih dari 5 --}}
            @if($styles->count() > 5)
                <button onclick="toggleStyles()" 
                        id="viewAllBtnDesktop"
                        class="hidden md:flex items-center gap-2 text-sm font-medium border-b border-black pb-0.5 hover:opacity-70 transition cursor-pointer">
                    View All Archives <span aria-hidden="true">&rarr;</span>
                </button>
            @endif
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">

            @forelse ($styles as $style)
                <div 
                    onclick="openStyle(
                        '{{ $style->name }}',
                        '{{ $style->description }}',
                        '{{ asset('storage/'.$style->image) }}'
                    )"
                    {{-- Logic Hide: Jika index >= 5 (item ke-6 dst), tambahkan class 'hidden' dan identifier 'extra-card' --}}
                    class="group relative h-[400px] rounded-xl overflow-hidden cursor-pointer bg-neutral-200 
                           {{ $loop->index >= 5 ? 'hidden extra-card' : '' }}">
                    
                    {{-- Image --}}
                    <img src="{{ asset('storage/'.$style->image) }}"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 filter grayscale group-hover:grayscale-0"
                         alt="{{ $style->name }}">

                    {{-- Overlay Gradient --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent opacity-80 transition-opacity"></div>

                    {{-- Content --}}
                    <div class="absolute bottom-0 left-0 p-6 w-full transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                        <h3 class="text-lg font-bold text-white mb-1 tracking-tight">
                            {{ $style->name }}
                        </h3>
                        <p class="text-xs text-neutral-300 line-clamp-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 delay-100">
                            {{ $style->description }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center border-2 border-dashed border-neutral-300 rounded-xl">
                    <p class="text-neutral-500 font-medium">No styles found.</p>
                </div>
            @endforelse

        </div>
        
        {{-- MOBILE BUTTON --}}
        @if($styles->count() > 5)
            <div class="mt-8 text-center md:hidden">
                 <button onclick="toggleStyles()" 
                         id="viewAllBtnMobile"
                         class="inline-flex items-center gap-2 text-sm font-medium border-b border-black pb-0.5 cursor-pointer">
                    View All Archives &rarr;
                </button>
            </div>
        @endif
    </div>
</section>

{{-- Script untuk Handle Toggle --}}
<script>
function toggleStyles() {
    // 1. Ambil semua elemen yang disembunyikan
    const hiddenCards = document.querySelectorAll('.extra-card');
    const btnDesktop = document.getElementById('viewAllBtnDesktop');
    const btnMobile = document.getElementById('viewAllBtnMobile');
    
    // 2. Cek status saat ini (apakah sedang hidden atau sudah tampil?)
    // Kita cek elemen pertama saja sebagai acuan
    if (hiddenCards.length > 0) {
        const isCurrentlyHidden = hiddenCards[0].classList.contains('hidden');

        hiddenCards.forEach(card => {
            card.classList.toggle('hidden');
        });

        // 3. Ubah Teks Tombol (Opsional, biar UX makin bagus)
        const newText = isCurrentlyHidden ? 'Show Less' : 'View All Archives';
        const newIcon = isCurrentlyHidden ? '&uarr;' : '&rarr;'; // Panah atas atau kanan

        if(btnDesktop) btnDesktop.innerHTML = `${newText} <span aria-hidden="true">${newIcon}</span>`;
        if(btnMobile) btnMobile.innerHTML = `${newText} <span aria-hidden="true">${newIcon}</span>`;
    }
}
</script>