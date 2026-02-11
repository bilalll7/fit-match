@extends('admin.layouts.app')

@section('content')

<div class="flex justify-between items-end mb-8">
    <div>
        <h1 class="text-3xl font-black text-neutral-900 tracking-tight">Styles</h1>
        <p class="text-neutral-500 text-sm mt-1">Manage your outfit aesthetic categories.</p>
    </div>

    <a href="{{ route('admin.styles.create') }}"
       class="bg-neutral-900 hover:bg-black text-white px-6 py-3 rounded-xl shadow-lg transition transform hover:-translate-y-1 text-sm font-bold flex items-center gap-2">
       <span>+</span> Create New
    </a>
</div>

<div class="bg-white rounded-3xl shadow-[0_2px_15px_rgb(0,0,0,0.04)] border border-neutral-100 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-neutral-50 text-neutral-400 text-xs uppercase tracking-wider font-semibold">
            <tr>
                <th class="p-6">Style Name</th>
                <th class="p-6">Description</th>
                <th class="p-6 text-center">Visual</th>
                <th class="p-6 text-center">Status</th>
                <th class="p-6 text-right">Actions</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-neutral-100">
            @foreach($styles as $style)
            <tr class="hover:bg-neutral-50 transition duration-150">
                <td class="p-6 font-bold text-neutral-900">
                    {{ $style->name }}
                </td>

                <td class="p-6 text-neutral-500 text-sm max-w-xs truncate">
                    {{ Str::limit($style->description, 60) }}
                </td>

                <td class="p-6 flex justify-center">
                    <img src="{{ asset('storage/' . $style->image) }}"
                         class="w-12 h-12 object-cover rounded-lg border border-neutral-200 shadow-sm">
                </td>

                <td class="p-6 text-center">
                    <form action="{{ route('admin.styles.toggle', $style) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button class="px-3 py-1 rounded-full text-xs font-bold border transition
                            {{ $style->is_active 
                                ? 'bg-neutral-900 text-white border-neutral-900' 
                                : 'bg-white text-neutral-400 border-neutral-300 hover:border-neutral-900 hover:text-neutral-900' }}">
                            {{ $style->is_active ? 'Active' : 'Inactive' }}
                        </button>
                    </form>
                </td>

                <td class="p-6 text-right">
                    <div class="flex justify-end items-center gap-4">
                        <a href="{{ route('admin.styles.edit', $style) }}"
                           class="text-sm font-medium text-neutral-600 hover:text-neutral-900 hover:underline">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('admin.styles.destroy', $style) }}"
                              x-data @submit.prevent="
                                Swal.fire({
                                    title: 'Delete Style?',
                                    text: 'This action is irreversible.',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#171717',
                                    cancelButtonColor: '#d4d4d4',
                                    confirmButtonText: 'Yes, Delete',
                                    cancelButtonText: 'Cancel',
                                    customClass: { popup: 'rounded-2xl', confirmButton: 'rounded-xl', cancelButton: 'rounded-xl' }
                                }).then((result) => { if (result.isConfirmed) $el.submit(); });
                              ">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-sm font-medium text-red-500 hover:text-red-700">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection