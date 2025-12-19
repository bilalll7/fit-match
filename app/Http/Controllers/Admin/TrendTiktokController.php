<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trend;
use App\Models\TrendTiktok;
use Illuminate\Http\Request;

class TrendTikTokController extends Controller
{
    public function store(Request $request, Trend $trend)
{
    $request->validate([
        'tiktok_url' => 'required|url',
        'caption'    => 'nullable|string',
        'creator_name' => 'nullable|string',
    ]);

    $trend->tiktoks()->create([
        'tiktok_url'   => $request->tiktok_url,
        'caption'      => $request->caption,
        'creator_name' => $request->creator_name,
    ]);

    return redirect()->route('admin.trends.index')
                 ->with('success', 'Trend berhasil dibuat');

}
    // Hapus TikTok
    public function destroy(TrendTikTok $tiktok)
    {
        $tiktok->delete();

        return back()->with('success', 'TikTok berhasil dihapus.');
    }

}

