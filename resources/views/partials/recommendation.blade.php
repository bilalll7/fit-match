<section class="max-w-7xl mx-auto px-6 py-12">
    <h2 class="text-xl font-semibold mb-6">Rekomendasi Hari Ini</h2>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @for ($i = 0; $i < 4; $i++)
            <div class="bg-white rounded-xl p-4 shadow">
                <div class="h-40 bg-gray-100 rounded mb-3"></div>
                <p class="text-sm font-medium">Outfit {{ $i+1 }}</p>
            </div>
        @endfor
    </div>
</section>
