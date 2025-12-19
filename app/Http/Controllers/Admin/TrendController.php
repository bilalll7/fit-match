<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class TrendController extends Controller
{
    public function index()
    {
        $trends = Trend::latest()->get();
        return view('admin.trends.index', compact('trends'));
    }

    public function create()
    {
        return view('admin.trends.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'image'       => 'required|image'
        ]);

        $image = $request->file('image')->store('trends', 'public');

        $trend = Trend::create([
            'title'       => $request->title,
            'description' => $request->description,
            'cover_image' => $image, // ubah dari 'image' menjadi 'cover_image'
            'is_active'   => true
        ]);

        return redirect()
            ->route('admin.trends.index', $trend)
            ->with('success', 'Trend berhasil dibuat');
    }

    public function edit(Trend $trend)
    {
        $trend->load('tiktoks');
        return view('admin.trends.edit', compact('trend'));
    }

    public function update(Request $request, Trend $trend)
    {
        $data = $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'image'       => 'nullable|image'
        ]);

        if ($request->hasFile('image')) {
            $data['cover_image'] = $request->file('image')
                ->store('trends', 'public');
        }

        $trend->update($data);

        return back()->with('success', 'Trend diperbarui');
    }

    public function toggle(Trend $trend)
    {
        $trend->update([
            'is_active' => ! $trend->is_active
        ]);

        return back();
    }

    public function destroy(Trend $trend)
    {
        $trend->delete();
        return back()->with('success', 'Trend dihapus');
    }
}
