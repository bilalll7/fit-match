@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between mb-6">
    <h1 class="text-2xl font-semibold">Eksplorasi Gaya</h1>
    <a href="{{ route('admin.styles.create') }}"
       class="bg-green-500 text-white px-4 py-2 rounded">
        + Tambah Style
    </a>
</div>

<table class="w-full bg-white rounded shadow">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-3 text-left">Nama</th>
            <th class="p-3 text-left">Deskripsi</th>
            <th class="p-3">Gambar</th>
            <th>Status</th>
            <th>Aksi</th>

        </tr>
    </thead>
    <tbody>
        @foreach($styles as $style)
        <tr class="border-t align-top">
            <td class="p-3 font-medium">{{ $style->name }}</td>

            <td class="p-3 text-sm text-gray-600">
                {{ Str::limit($style->description, 80) }}
            </td>

            <td class="p-3">
                <img
                    src="{{ asset('storage/' . $style->image) }}"
                    class="w-20 h-24 object-cover rounded">
            </td>
<td class="p-3">
    <form action="{{ route('admin.styles.toggle', $style) }}" method="POST">
        @csrf
        @method('PATCH')

        <button
            class="px-3 py-1 rounded text-white text-sm
            {{ $style->is_active ? 'bg-green-500' : 'bg-gray-400' }}">
            {{ $style->is_active ? 'Aktif' : 'Nonaktif' }}
        </button>
    </form>
</td>

<td class="flex gap-4 p-3">
    <a href="{{ route('admin.styles.edit', $style) }}"
       class="text-blue-500">
        Edit
    </a>

    <form method="POST"
          action="{{ route('admin.styles.destroy', $style) }}"
          onsubmit="return confirm('Yakin ingin menghapus style ini?')">
        @csrf
        @method('DELETE')
        <button class="text-red-500">
            Hapus
        </button>
    </form>
</td>

        </tr>
        @endforeach
    </tbody>
</table>

@endsection
