<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

  public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'role' => 'required|in:top,bottom,outer,shoes,accessory',
    ]);

    Category::create([
        'name' => $request->name,
        'role' => $request->role,
        'is_active' => true,
    ]);

    return redirect()->route('admin.categories.index')
                     ->with('success', 'Kategori berhasil ditambahkan');
}


    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

   public function update(Request $request, Category $category)
{
    $request->validate([
        'name' => 'required',
        'role' => 'required|in:top,bottom,outer,shoes,accessory',
    ]);

    $category->update([
        'name' => $request->name,
        'role' => $request->role,
        'is_active' => $request->has('is_active'),
    ]);

    return redirect()->route('admin.categories.index')
                     ->with('success', 'Kategori berhasil diperbarui');
}


    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}
