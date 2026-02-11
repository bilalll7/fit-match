<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Style;
use App\Models\Category; // Pastikan model Category ada
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // UBAH NAMA FUNCTION DARI 'dashboard' KE 'index'
    public function index()
    {
        // 1. Ambil Total Data
        $totalStyles = Style::count();
        
        // Pastikan Model Category sudah dibuat. Kalau belum ada, ganti jadi 0 dulu atau buat Modelnya.
        $totalCategories = class_exists(Category::class) ? Category::count() : 0; 
        
        // Pastikan kolom 'role' ada di tabel users. Kalau tidak ada, hapus where-nya.
        $totalUsers = User::count(); 
        // Kalau mau spesifik role user: $totalUsers = User::where('role', 'user')->count();

        // 2. Data untuk Chart
        // Pastikan kolom 'is_active' ada di tabel styles. Kalau tidak ada, hapus bagian ini.
        // Cek apakah kolom is_active ada? Kalau ragu, kita defaultkan saja dulu biar gak error
        try {
            $activeStyles = Style::where('is_active', true)->count();
            $inactiveStyles = Style::where('is_active', false)->count();
        } catch (\Exception $e) {
            // Fallback kalau kolom is_active belum ada di database
            $activeStyles = $totalStyles; 
            $inactiveStyles = 0;
        }

        // 3. Kirim ke View
        return view('admin.dashboard.index', compact(
            'totalStyles', 
            'totalCategories', 
            'totalUsers',
            'activeStyles',
            'inactiveStyles'
        ));
    }
}