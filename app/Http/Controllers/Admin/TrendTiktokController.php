<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trend;
use App\Models\TrendTikTok;
use Illuminate\Http\Request;

class TrendTikTokController extends Controller
{
    public function store(Request $request, Trend $trend)
    {
        $request->validate([
            'tiktok_url' => 'required'
        ]);

        TrendTikTok::create([
            'trend_id' => $trend->id,
            'tiktok_url' => $request->tiktok_url,
            'creator_name' => $request->creator_name,
            'caption' => $request->caption,
        ]);

        return back()->with('success', 'TikTok trend ditambahkan');
    }
}
