<form method="POST"
      action="{{ route('admin.trends.store') }}"
      enctype="multipart/form-data"
      class="max-w-xl mx-auto py-20 space-y-6">

    @csrf

    <input name="title" placeholder="Judul Trend"
           class="w-full border p-3 rounded-xl">

    <textarea name="description"
              placeholder="Deskripsi trend"
              class="w-full border p-3 rounded-xl"></textarea>

    <input type="file" name="image" class="w-full">

    <button class="bg-green-500 text-white px-6 py-3 rounded-xl">
        Simpan
    </button>
</form>
