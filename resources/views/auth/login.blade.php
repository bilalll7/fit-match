@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 font-poppins">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow">
        <h2 class="text-2xl font-bold text-center mb-6">Login FitMatch</h2>

        <form id="loginForm" method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" class="w-full mt-1 px-4 py-2 border rounded-lg" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Password</label>
                <input type="password" name="password" class="w-full mt-1 px-4 py-2 border rounded-lg" required>
            </div>

            @error('email')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror

        <button type="button"
            onclick="confirmLogin()"
            class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">
            Login
        </button>

        </form>

        <p class="text-center text-sm mt-4">
            Belum punya akun?
            <a href="{{ route('register') }}" class="underline">Register</a>
        </p>
    </div>
</div>
@endsection


<script>
function confirmLogin() {
    Swal.fire({
        title: 'Konfirmasi Login',
        text: 'Apakah kamu yakin ingin login?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Login',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#16a34a',
        cancelButtonColor: '#6b7280'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('loginForm').submit();
        }
    });
}
</script>
