<form method="POST" action="{{ route('admin.categories.store') }}">
    @csrf
    <input name="name" placeholder="Nama kategori"
           class="border p-2 w-full rounded" required>

    <button class="mt-4 bg-green-500 text-white px-4 py-2 rounded">
        Simpan
    </button>
</form>
