@extends('admin.layouts.app')

@section('content')

<div class="flex justify-between items-end mb-8">
    <div>
        <h1 class="text-3xl font-black text-neutral-900 tracking-tight">Categories</h1>
        <p class="text-neutral-500 text-sm mt-1">Organize outfits by clothing type.</p>
    </div>

    <a href="{{ route('admin.categories.create') }}"
       class="bg-neutral-900 hover:bg-black text-white px-6 py-3 rounded-xl shadow-lg transition transform hover:-translate-y-1 text-sm font-bold flex items-center gap-2">
       <span>+</span> Add Category
    </a>
</div>

<div class="bg-white rounded-3xl shadow-[0_2px_15px_rgb(0,0,0,0.04)] border border-neutral-100 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-neutral-50 text-neutral-400 text-xs uppercase tracking-wider font-semibold">
            <tr>
                <th class="p-6">Category Name</th>
                <th class="p-6 text-center">Role Type</th>
                <th class="p-6 text-center">Status</th>
                <th class="p-6 text-right">Actions</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-neutral-100">
            @foreach($categories as $category)
            <tr class="hover:bg-neutral-50 transition duration-150">
                <td class="p-6 font-bold text-neutral-900">
                    {{ $category->name }}
                </td>

                <td class="p-6 text-center">
                    <span class="px-3 py-1 rounded-lg text-xs font-medium bg-neutral-100 text-neutral-600 border border-neutral-200">
                        {{ ucfirst($category->role) }}
                    </span>
                </td>

                <td class="p-6 text-center">
                    <span class="text-xs font-bold {{ $category->is_active ? 'text-neutral-900' : 'text-neutral-400' }}">
                        {{ $category->is_active ? '● Active' : '○ Inactive' }}
                    </span>
                </td>

                <td class="p-6 text-right">
                    <div class="flex justify-end items-center gap-4">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="text-sm font-medium text-neutral-600 hover:text-black">Edit</a>
                        
                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                              x-data @submit.prevent="Swal.fire({
                                    title: 'Delete Category?',
                                    text: 'Cannot be undone.',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#171717',
                                    cancelButtonColor: '#d4d4d4',
                                    confirmButtonText: 'Delete'
                                }).then((result) => { if (result.isConfirmed) $el.submit(); });">
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