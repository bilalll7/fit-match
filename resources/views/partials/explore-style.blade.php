<section class="py-24 bg-green-50">
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-16">
            <h2 class="text-4xl font-serif font-semibold text-gray-900 mb-4">
                Eksplorasi Gaya
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Temukan inspirasi gaya fashion yang bisa kamu terapkan
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8">

            @forelse ($styles as $style)
                <div
                    onclick="openStyle(
                        '{{ $style->name }}',
                        '{{ $style->description }}',
                        '{{ asset('storage/'.$style->image) }}'
                    )"
                    class="group relative h-[420px] rounded-3xl overflow-hidden shadow-lg cursor-pointer">

                    <img
                        src="{{ asset('storage/'.$style->image) }}"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                        alt="{{ $style->name }}">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>

                    <div class="absolute bottom-6 left-6 right-6 text-white">
                        <h3 class="text-xl font-semibold mb-1">
                            {{ $style->name }}
                        </h3>
                        <p class="text-sm opacity-90">
                            {{ Str::limit($style->description, 60) }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500">
                    Belum ada gaya tersedia.
                </p>
            @endforelse

        </div>
    </div>
</section>

{{-- <dialog id="styleModal" class="rounded-2xl w-full max-w-md p-0">
    <div class="bg-white p-6">
        <img id="modalImage" class="w-full h-64 object-cover rounded-xl mb-4">

        <h3 id="modalTitle" class="text-2xl font-semibold mb-2"></h3>
        <p id="modalDesc" class="text-gray-600 mb-6"></p>

        <button onclick="closeStyle()"
                class="w-full bg-green-500 text-white py-2 rounded-lg">
            Tutup
        </button>
    </div>
</dialog>

<script>
function openStyle(name, desc, img) {
    modalTitle.innerText = name;
    modalDesc.innerText = desc;
    modalImage.src = img;
    styleModal.showModal();
}

function closeStyle() {
    styleModal.close();
}
</script> --}}
