@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 font-poppins">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow">
        <h2 class="text-2xl font-bold text-center mb-6">Register FitMatch</h2>

        <form id="registerForm" method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <input type="text" name="name" placeholder="Nama"
                class="w-full px-4 py-2 border rounded-lg" required>

            <input type="email" name="email" placeholder="Email"
                class="w-full px-4 py-2 border rounded-lg" required>

            <input type="password" name="password" placeholder="Password"
                class="w-full px-4 py-2 border rounded-lg" required>

            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password"
                class="w-full px-4 py-2 border rounded-lg" required>

        <button type="button"
            onclick="confirmRegister()"
            class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">
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

<script>
function confirmRegister() {
    Swal.fire({
        title: 'Konfirmasi Pendaftaran',
        text: 'Apakah data yang kamu masukkan sudah benar?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Daftar',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#16a34a',
        cancelButtonColor: '#6b7280'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('registerForm').submit();
        }
    });
}
</script>
