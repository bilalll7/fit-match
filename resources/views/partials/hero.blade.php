<section class="relative pt-28 pb-16 md:pt-36 md:pb-32 bg-white overflow-hidden">
    {{-- Background Pattern (Grid Halus) --}}
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#f5f5f5_1px,transparent_1px),linear-gradient(to_bottom,#f5f5f5_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)]"></div>

    <div class="relative max-w-7xl mx-auto px-6 text-center z-10">
        
        {{-- Badge Kecil --}}
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-neutral-200 bg-white mb-6 md:mb-8 shadow-sm">
            <span class="w-2 h-2 rounded-full bg-black relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-neutral-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-black"></span>
            </span>
            <span class="text-[10px] md:text-xs font-bold uppercase tracking-widest text-neutral-600">Personal Outfit Curator</span>
        </div>

        {{-- Headline Besar --}}
        <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold tracking-tighter text-neutral-900 mb-6 leading-[0.9]">
            DEFINE YOUR <br class="hidden md:block" />
            <span class="text-neutral-400">SIGNATURE</span> LOOK.
        </h1>

        {{-- Subheadline --}}
        <p class="text-base md:text-lg text-neutral-600 max-w-xl mx-auto mb-8 md:mb-10 leading-relaxed font-medium">
            Kelola lemari digitalmu. Dapatkan kurasi outfit harian berbasis AI. 
            Tampil percaya diri tanpa pusing memilih.
        </p>

        {{-- Buttons (CTA) --}}
        <div class="flex flex-col sm:flex-row justify-center gap-3 md:gap-4">
            <a href="{{ auth()->check() ? route('outfits.index') : route('login') }}"
               class="px-8 py-3.5 rounded-lg bg-neutral-900 text-white font-semibold text-sm md:text-base hover:bg-black hover:-translate-y-1 transition-all duration-300 shadow-xl shadow-neutral-200">
               Generate Outfit
            </a>

            <a href="{{ auth()->check() ? route('outfits.create') : route('login') }}"
               class="px-8 py-3.5 rounded-lg border border-neutral-200 bg-white text-neutral-900 font-semibold text-sm md:text-base hover:bg-neutral-50 hover:border-neutral-300 transition-all duration-300">
                Upload Collection
            </a>
        </div>
    </div>
</section>