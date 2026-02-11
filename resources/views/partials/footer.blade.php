<footer class="bg-neutral-950 border-t border-neutral-800 pt-16 pb-8 text-neutral-400">
    <div class="max-w-7xl mx-auto px-6">
        
        <div class="flex flex-col md:flex-row justify-between gap-12 mb-16">
            
            {{-- BRAND COLUMN (Kiri) --}}
            <div class="md:w-1/3">
                <a href="{{ route('home') }}" class="text-2xl font-bold tracking-tighter text-white flex items-center gap-2">
                    <div class="w-6 h-6 bg-white text-black flex items-center justify-center rounded text-xs">FM</div>
                    FitMatch.
                </a>
                <p class="mt-4 text-sm leading-relaxed text-neutral-500">
                    Your personal outfit curator. Kelola lemari digitalmu dan temukan gaya terbaik setiap hari.
                </p>
                
                {{-- Social Icons --}}
                <div class="flex gap-3 mt-6">
                    {{-- Twitter / X --}}
                    <a href="#" class="w-9 h-9 rounded-full bg-neutral-900 flex items-center justify-center hover:bg-white hover:text-black transition-all duration-300 border border-neutral-800">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    {{-- Instagram --}}
                    <a href="#" class="w-9 h-9 rounded-full bg-neutral-900 flex items-center justify-center hover:bg-white hover:text-black transition-all duration-300 border border-neutral-800">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                </div>
            </div>

            {{-- MENU / LINKS (Kanan - Sesuai Navbar) --}}
            <div class="md:w-2/3 flex flex-col md:flex-row justify-end gap-10 md:gap-20">
                
                {{-- Main Menu --}}
                <div>
                    <h4 class="font-bold text-white mb-6 text-xs uppercase tracking-widest">Menu</h4>
                    <ul class="space-y-4 text-sm">
                        <li>
                            <a href="{{ route('home') }}" class="hover:text-white transition-colors {{ request()->routeIs('home') ? 'text-white' : '' }}">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ auth()->check() ? route('outfits.index') : route('login') }}" class="hover:text-white transition-colors">
                                Match Your Outfit
                            </a>
                        </li>
                        <li>
                            <a href="{{ auth()->check() ? route('find-outfit.index') : route('login') }}" class="hover:text-white transition-colors {{ request()->routeIs('find-outfit.*') ? 'text-white' : '' }}">
                                Find Your Outfit
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Account Menu (Tambahan biar lengkap) --}}
                <div>
                    <h4 class="font-bold text-white mb-6 text-xs uppercase tracking-widest">Account</h4>
                    <ul class="space-y-4 text-sm">
                        @auth
                            <li>
                                <span class="text-neutral-500">Hi, {{ auth()->user()->name }}</span>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="hover:text-red-400 transition-colors text-left">
                                        Sign Out
                                    </button>
                                </form>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('login') }}" class="hover:text-white transition-colors">Log In</a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}" class="hover:text-white transition-colors">Register</a>
                            </li>
                        @endauth
                    </ul>
                </div>

            </div>
        </div>

        {{-- COPYRIGHT --}}
        <div class="pt-8 border-t border-neutral-900 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-xs text-neutral-600 font-medium">
                &copy; <span id="year"></span> FitMatch Inc.
            </p>
            <div class="flex gap-6">
                <a href="#" class="text-xs text-neutral-600 hover:text-white transition-colors">Privacy</a>
                <a href="#" class="text-xs text-neutral-600 hover:text-white transition-colors">Terms</a>
            </div>
        </div>
    </div>
</footer>

<script>
    document.getElementById('year').textContent = new Date().getFullYear();
</script>