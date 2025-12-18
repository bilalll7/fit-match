@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between mb-6">
    <h1 class="text-2xl font-semibold">Kategori Outfit</h1>
    <a href="{{ route('admin.categories.create') }}"
       class="bg-green-500 text-white px-4 py-2 rounded">
        + Tambah Kategori
    </a>
</div>

<table class="w-full bg-white rounded shadow">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-3 text-left">Nama</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr class="border-t">
            <td class="p-3">{{ $category->name }}</td>
            <td>
                {{ $category->is_active ? 'Aktif' : 'Nonaktif' }}
            </td>
            <td class="flex gap-3 p-3">
                <a href="{{ route('admin.categories.edit', $category) }}"
                   class="text-blue-500">Edit</a>

                <form method="POST"
                      action="{{ route('admin.categories.destroy', $category) }}">
                    @csrf @method('DELETE')
                    <button class="text-red-500"
                        onclick="return confirm('Hapus kategori?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
