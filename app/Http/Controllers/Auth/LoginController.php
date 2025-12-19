<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

public function login(Request $request)
{
    $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        // Redirect berdasarkan role
        if ($user->role === 'admin') {
            return redirect()
                ->route('admin.dashboard')
                ->with('success', 'Login admin berhasil');
        }

        return redirect()
            ->route('home')
            ->with('success', 'Login berhasil. Selamat datang!');
    }

    return back()
        ->with('error', 'Email atau password salah')
        ->withInput($request->only('email'));
}

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
        ->route('home')
        ->with('success', 'Anda berhasil logout.');

    }
}
