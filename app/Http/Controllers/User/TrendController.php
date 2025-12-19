<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Trend;

class TrendController extends Controller
{
    public function index()
    {
        $trends = Trend::with('tiktoks')
            ->where('is_active', true)
            ->latest()
            ->get();

        return view('find-outfit.trend', compact('trends'));
    }
}
