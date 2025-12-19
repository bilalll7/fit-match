@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto px-6 py-24">

    <h1 class="text-2xl font-semibold mb-6">Tambah Outfit</h1>

    <form id="outfitForm"
          method="POST"
          action="{{ route('outfits.store') }}"
          enctype="multipart/form-data"
          class="bg-white p-6 rounded-2xl shadow space-y-5">
        @csrf

        <div>
            <label class="text-sm font-medium">Nama Outfit</label>
            <input name="name"
                   class="w-full border rounded px-4 py-2"
                   required>
        </div>

        <div>
            <label class="text-sm font-medium">Kategori</label>
            <select name="category_id"
                    class="w-full border rounded px-4 py-2"
                    required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="text-sm font-medium">Gambar</label>
            <input type="file"
                   name="image"
                   class="w-full"
                   required>
        </div>

        <button type="button"
                onclick="confirmSubmit()"
                class="w-full bg-green-500 text-white py-3 rounded-full font-medium">
            Simpan Outfit
        </button>
    </form>
</div>
@endsection

@push('scripts')
<script>
function confirmSubmit() {
    Swal.fire({
        title: 'Simpan Outfit?',
        text: 'Pastikan data sudah benar',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Simpan',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#16a34a',
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('outfitForm').submit();
        }
    });
}
</script>
@endpush
@if ($errors->any())
<script>
Swal.fire({
    icon: 'error',
    title: 'Gagal',
    text: 'Periksa kembali input kamu'
});
</script>
@endif
