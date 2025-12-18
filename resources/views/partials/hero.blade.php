<section class="min-h-[calc(100vh-5rem)] flex items-center justify-center bg-gradient-to-br from-green-50 to-emerald-100">
    <div class="text-center max-w-3xl px-4">

        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-100 text-green-700 text-xs md:text-sm mb-6">
            ✨ Your Personal Outfit Curator
        </span>

        <h1 class="text-4xl md:text-6xl font-serif font-semibold text-gray-900 mb-6">
            Temukan Gaya
        </h1>

        <p class="text-gray-600 text-base md:text-lg mb-10">
            Kelola koleksi pakaianmu dan dapatkan rekomendasi outfit yang sempurna
            untuk setiap kesempatan
        </p>

        <div class="flex flex-col md:flex-row justify-center gap-4 md:gap-6">
            <a href="{{ auth()->check() ? route('outfits.index') : route('login') }}"
               class="px-8 py-4 rounded-full bg-gradient-to-r from-green-400 to-emerald-500 text-white font-medium shadow-lg">
                Find Your Outfit →
            </a>

            <a href="{{ auth()->check() ? route('outfits.create') : route('login') }}"
               class="px-8 py-4 rounded-full border-2 border-green-400 text-green-600 font-medium">
                Upload Outfitmu
            </a>
        </div>
    </div>
</section>
