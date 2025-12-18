@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 font-poppins">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow">
        <h2 class="text-2xl font-bold text-center mb-6">Register FitMatch</h2>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <input type="text" name="name" placeholder="Nama"
                class="w-full px-4 py-2 border rounded-lg" required>

            <input type="email" name="email" placeholder="Email"
                class="w-full px-4 py-2 border rounded-lg" required>

            <input type="password" name="password" placeholder="Password"
                class="w-full px-4 py-2 border rounded-lg" required>

            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password"
                class="w-full px-4 py-2 border rounded-lg" required>

            <button class="w-full bg-black text-white py-2 rounded-lg">
                Register
            </button>
        </form>

        <p class="text-center text-sm mt-4">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="underline">Login</a>
        </p>
    </div>
</div>
@endsection
