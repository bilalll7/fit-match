<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Outfit;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class OutfitController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();

        $outfits = Outfit::with('category')
            ->where('user_id', Auth::id())
            ->when($request->category, function ($query) use ($request) {
                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('name', $request->category);
                });
            })
            ->latest()
            ->get();

        return view('outfits.index', compact('categories', 'outfits'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('outfits.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $request->file('image')->store('outfits', 'public');

        Outfit::create([
            'name'        => $request->name,
            'category_id' => $request->category_id,
            'image'       => $imagePath,
            'user_id'     => Auth::id(),
        ]);

        return redirect()->route('outfits.index')
            ->with('success', 'Outfit berhasil ditambahkan');
    }

    public function edit(Outfit $outfit)
    {
        abort_if($outfit->user_id !== Auth::id(), 403);

        $categories = Category::orderBy('name')->get();
        return view('outfits.edit', compact('outfit', 'categories'));
    }

    public function update(Request $request, Outfit $outfit)
    {
        abort_if($outfit->user_id !== Auth::id(), 403);

        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($outfit->image) {
                Storage::disk('public')->delete($outfit->image);
            }
            $outfit->image = $request->file('image')->store('outfits', 'public');
        }

        $outfit->update([
            'name'        => $request->name,
            'category_id' => $request->category_id,
            'image'       => $outfit->image,
        ]);

        return redirect()->route('outfits.index')
            ->with('success', 'Outfit berhasil diperbarui');
    }

    public function destroy(Outfit $outfit)
    {
        abort_if($outfit->user_id !== Auth::id(), 403);

        if ($outfit->image) {
            Storage::disk('public')->delete($outfit->image);
        }

        $outfit->delete();

        return redirect()->route('outfits.index')
            ->with('success', 'Outfit berhasil dihapus');
    }
}
