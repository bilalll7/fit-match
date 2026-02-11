@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-neutral-50 font-poppins">
    
    <div class="w-full max-w-md bg-white p-10 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-neutral-100">
        
        <div class="text-center mb-10">
            <h1 class="text-4xl font-black text-neutral-900 tracking-tighter mb-2">FitMatch.</h1>
            <p class="text-neutral-500 text-sm">Create your style profile.</p>
        </div>

        <form id="registerForm" method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-neutral-500 mb-2">Full Name</label>
                <input type="text" name="name" required
                    class="w-full px-4 py-3 bg-neutral-50 border border-neutral-200 rounded-xl text-neutral-900 placeholder-neutral-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-200">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-neutral-500 mb-2">Email</label>
                <input type="email" name="email" required
                    class="w-full px-4 py-3 bg-neutral-50 border border-neutral-200 rounded-xl text-neutral-900 placeholder-neutral-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-200">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-neutral-500 mb-2">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 bg-neutral-50 border border-neutral-200 rounded-xl text-neutral-900 placeholder-neutral-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-200">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-neutral-500 mb-2">Confirm</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-4 py-3 bg-neutral-50 border border-neutral-200 rounded-xl text-neutral-900 placeholder-neutral-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-200">
                </div>
            </div>

            <button type="button" onclick="confirmRegister()"
                class="w-full mt-4 bg-neutral-900 text-white font-bold py-4 rounded-xl hover:bg-black hover:scale-[1.02] transition-all duration-300 shadow-lg">
                Create Account
            </button>
        </form>

        <div class="mt-8 text-center border-t border-neutral-100 pt-6">
            <p class="text-neutral-500 text-sm">
                Already have an account? 
                <a href="{{ route('login') }}" class="font-bold text-neutral-900 hover:underline">Sign In</a>
            </p>
        </div>
    </div>
</div>

<script>
function confirmRegister() {
    Swal.fire({
        title: 'Create Account',
        text: 'Are your details correct?',
        icon: 'question',
        color: '#171717',
        showCancelButton: true,
        confirmButtonText: 'Yes, Register',
        cancelButtonText: 'Check Again',
        confirmButtonColor: '#171717',
        cancelButtonColor: '#d4d4d4',
        iconColor: '#171717',
        customClass: {
            popup: 'rounded-2xl',
            confirmButton: 'rounded-xl px-6 py-3 font-bold',
            cancelButton: 'rounded-xl px-6 py-3 text-neutral-600'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('registerForm').submit();
        }
    });
}
</script>
@endsection