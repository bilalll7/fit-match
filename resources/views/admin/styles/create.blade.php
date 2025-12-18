@extends('admin.layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-6">Tambah Style</h1>

<form method="POST" action="{{ route('admin.styles.store') }}" enctype="multipart/form-data"
      class="bg-white p-6 rounded-xl shadow space-y-4">
    @csrf

    <div>
        <label class="block text-sm font-medium mb-1">Nama Style</label>
        <input type="text" name="name"
               class="w-full border rounded-lg px-4 py-2" required>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Deskripsi</label>
        <textarea
            name="description"
            rows="4"
            class="w-full border rounded-lg px-3 py-2"
            required></textarea>
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Gambar</label>
        <input type="file" name="image"
               class="w-full border rounded-lg px-4 py-2">
    </div>

    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_active" checked>
        <span class="text-sm">Aktifkan style</span>
    </div>

    <button type="submit"
            class="bg-green-600 text-white px-6 py-2 rounded-lg">
        Simpan
    </button>
</form>
@endsection
