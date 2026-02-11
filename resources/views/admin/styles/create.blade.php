@extends('admin.layouts.app')

@section('content')

<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.styles.index') }}" class="text-neutral-400 hover:text-neutral-900 text-sm mb-4 inline-block">&larr; Back to Styles</a>
        <h1 class="text-3xl font-black text-neutral-900">Add New Style</h1>
    </div>

    <div class="bg-white rounded-3xl shadow-[0_4px_20px_rgb(0,0,0,0.03)] border border-neutral-100 p-8">
        <form method="POST" action="{{ route('admin.styles.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Nama --}}
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-neutral-500 mb-2">Style Name</label>
                <input type="text" name="name" required placeholder="e.g. Streetwear"
                    class="w-full px-4 py-3 bg-neutral-50 border border-neutral-200 rounded-xl text-neutral-900 placeholder-neutral-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-black transition">
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-neutral-500 mb-2">Description</label>
                <textarea name="description" rows="4" required placeholder="Describe the aesthetic..."
                    class="w-full px-4 py-3 bg-neutral-50 border border-neutral-200 rounded-xl text-neutral-900 placeholder-neutral-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-black transition"></textarea>
            </div>

            {{-- Upload --}}
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-neutral-500 mb-2">Cover Image</label>
                <input type="file" name="image"
                    class="block w-full text-sm text-neutral-500
                    file:mr-4 file:py-2.5 file:px-4
                    file:rounded-xl file:border-0
                    file:text-xs file:font-bold
                    file:bg-neutral-900 file:text-white
                    hover:file:bg-black transition">
            </div>

            {{-- Checkbox --}}
            <div class="flex items-center gap-3 pt-2">
                <input type="checkbox" name="is_active" id="is_active" checked
                    class="w-5 h-5 text-black border-neutral-300 rounded focus:ring-black">
                <label for="is_active" class="text-sm font-medium text-neutral-700">Set as Active</label>
            </div>

            {{-- Buttons --}}
            <div class="pt-6 flex gap-4">
                <button type="submit" class="flex-1 bg-neutral-900 text-white font-bold py-3 rounded-xl hover:bg-black transition shadow-lg">
                    Save Style
                </button>
            </div>
        </form>
    </div>
</div>

@endsection