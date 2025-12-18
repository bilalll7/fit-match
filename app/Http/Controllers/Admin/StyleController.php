<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Style;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StyleController extends Controller
{
    public function index()
    {
        $styles = Style::latest()->get();
        return view('admin.styles.index', compact('styles'));
    }

    public function create()
    {
        return view('admin.styles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png',
        ]);


        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('styles', 'public');
        }

        Style::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()
            ->route('admin.styles.index')
            ->with('success', 'Style berhasil ditambahkan');
    }


    public function edit(Style $style)
    {
        return view('admin.styles.edit', compact('style'));
    }
public function update(Request $request, Style $style)
{
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'image' => 'nullable|image',
    ]);

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('styles', 'public');
        $style->image = $path;
    }

    $style->update([
        'name' => $request->name,
        'description' => $request->description,
    ]);

    return redirect()
        ->route('admin.styles.index')
        ->with('success', 'Style berhasil diupdate');
}

    public function destroy(Style $style)
    {
        $style->delete();

        return redirect()
            ->route('admin.styles.index')
            ->with('success', 'Style berhasil dihapus');
    }

    public function toggle(Style $style)
    {
        $style->update([
            'is_active' => !$style->is_active
        ]);

        return back()->with('success', 'Status style berhasil diubah');
    }

}

