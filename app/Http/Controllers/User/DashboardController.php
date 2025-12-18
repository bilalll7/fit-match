<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Style;

class DashboardController extends Controller
{
public function index()
{
    $styles = Style::where('is_active', true)->get();

    return view('dashboard.index', compact('styles'));
}
    
}
