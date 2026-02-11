@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-neutral-50 font-poppins">
    
    <div class="w-full max-w-md bg-white p-10 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-neutral-100">
        
        {{-- Header Simpel --}}
        <div class="text-center mb-10">
            <h1 class="text-4xl font-black text-neutral-900 tracking-tighter mb-2">FitMatch.</h1>
            <p class="text-neutral-500 text-sm">Sign in to manage your wardrobe.</p>
        </div>

        <form id="loginForm" method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div class="space-y-5">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-neutral-500 mb-2">Email</label>
                    <input type="email" name="email" required 
                        class="w-full px-4 py-3 bg-neutral-50 border border-neutral-200 rounded-xl text-neutral-900 placeholder-neutral-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-200"
                        placeholder="name@example.com">
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-neutral-500">Password</label>
                        {{-- Optional: Forgot Password Link --}}
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs text-neutral-400 hover:text-black transition">Forgot?</a>
                        @endif
                    </div>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 bg-neutral-50 border border-neutral-200 rounded-xl text-neutral-900 placeholder-neutral-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-200"
                        placeholder="••••••••">
                </div>
            </div>

            @error('email')
                <p class="text-red-600 text-xs mt-1 font-medium">{{ $message }}</p>
            @enderror

            <button type="button" onclick="confirmLogin()"
                class="w-full bg-neutral-900 text-white font-bold py-4 rounded-xl hover:bg-black hover:scale-[1.02] transition-all duration-300 shadow-lg">
                Sign In
            </button>

        </form>

        <div class="mt-8 text-center border-t border-neutral-100 pt-6">
            <p class="text-neutral-500 text-sm">
                Don't have an account? 
                <a href="{{ route('register') }}" class="font-bold text-neutral-900 hover:underline">Register</a>
            </p>
        </div>
    </div>
</div>

<script>
function confirmLogin() {
    Swal.fire({
        title: 'Sign In',
        text: 'Proceed to your dashboard?',
        icon: 'question',
        color: '#171717', // Text hitam
        showCancelButton: true,
        confirmButtonText: 'Yes, Enter',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#171717', // Tombol Hitam
        cancelButtonColor: '#d4d4d4', // Tombol Abu
        background: '#ffffff',
        iconColor: '#171717',
        customClass: {
            popup: 'rounded-2xl',
            confirmButton: 'rounded-xl px-6 py-3 font-bold',
            cancelButton: 'rounded-xl px-6 py-3 text-neutral-600'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('loginForm').submit();
        }
    });
}
</script>
@endsection