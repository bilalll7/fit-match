@extends('admin.layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-6">Edit Style</h1>

<form method="POST"
      action="{{ route('admin.styles.update', $style) }}"
      enctype="multipart/form-data"
      class="bg-white p-6 rounded shadow max-w-xl">

    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block mb-1">Nama Style</label>
        <input type="text"
               name="name"
               value="{{ old('name', $style->name) }}"
               class="w-full border px-4 py-2 rounded">
    </div>

    <div class="mb-4">
        <label class="block mb-1">Deskripsi</label>
        <textarea name="description"
                  class="w-full border px-4 py-2 rounded"
                  rows="4">{{ old('description', $style->description) }}</textarea>
    </div>

    <div class="mb-4">
        <label class="block mb-1">Gambar</label>
        <input type="file" name="image">
        <img src="{{ asset('storage/'.$style->image) }}"
             class="w-32 mt-3 rounded">
    </div>

    <div class="flex gap-4">
        <button class="bg-green-500 text-white px-4 py-2 rounded">
            Update
        </button>

        <a href="{{ route('admin.styles.index') }}"
           class="px-4 py-2 border rounded">
            Batal
        </a>
    </div>
</form>
@endsection
