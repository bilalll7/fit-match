@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto px-6 py-24">

    <h1 class="text-2xl font-semibold mb-6">Edit Outfit</h1>

<form id="updateForm"
      method="POST"
      action="{{ route('outfits.update',$outfit) }}"
      enctype="multipart/form-data"
      class="bg-white p-6 rounded-2xl shadow space-y-5">

        @csrf @method('PUT')

        <div>
            <label class="text-sm">Nama Outfit</label>
            <input name="name"
                   value="{{ $outfit->name }}"
                   class="w-full border rounded px-4 py-2"
                   required>
        </div>

        <div>
            <label class="text-sm">Kategori</label>
            <select name="category_id"
                    class="w-full border rounded px-4 py-2">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $outfit->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="text-sm">Gambar (opsional)</label>
            <input type="file" name="image">
        </div>

        <img src="{{ asset('storage/'.$outfit->image) }}"
             class="h-40 rounded mt-3">

            <button type="button"
                    onclick="confirmUpdate()"
                    class="w-full bg-green-500 text-white py-3 rounded-full">
                Update Outfit
            </button>

    </form>
</div>
@endsection

@push('scripts')
<script>
function confirmUpdate() {
    Swal.fire({
        title: 'Update Outfit?',
        text: 'Perubahan akan disimpan',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Update',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#16a34a',
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('updateForm').submit();
        }
    });
}
</script>
@endpush
