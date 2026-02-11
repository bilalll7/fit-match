<nav class="fixed top-0 left-0 w-full h-20 bg-white/80 backdrop-blur-md border-b border-neutral-200 z-50">
    <div class="max-w-7xl mx-auto px-6 h-full flex items-center justify-between">

        {{-- LOGO (Minimalist) --}}
        <a href="{{ route('home') }}" class="flex items-center gap-2 group">
            <div class="w-8 h-8 bg-black text-white flex items-center justify-center font-bold text-sm tracking-tighter rounded-md group-hover:rotate-3 transition-transform">
                OuT
            </div>
            <span class="font-bold text-xl tracking-tight text-neutral-900">FitMatch.</span>
        </a>

        {{-- DESKTOP MENU --}}
        <div class="hidden md:flex items-center gap-10 text-sm font-medium text-neutral-600">
            <a href="{{ route('home') }}"
               class="hover:text-black transition-colors {{ request()->routeIs('home') ? 'text-black font-semibold' : '' }}">
                Dashboard
            </a>

            <a href="{{ auth()->check() ? route('outfits.index') : route('login') }}"
               class="hover:text-black transition-colors">
                Collection
            </a>

            <a href="{{ auth()->check() ? route('find-outfit.index') : route('login') }}"
               class="hover:text-black transition-colors {{ request()->routeIs('find-outfit.*') ? 'text-black font-semibold' : '' }}">
                Generate Fit
            </a>
        </div>

        {{-- RIGHT SIDE --}}
        <div class="flex items-center gap-4">
            @guest
                <a href="{{ route('login') }}"
                   class="hidden md:inline-block text-sm font-medium text-neutral-600 hover:text-black transition">
                    Log In
                </a>
                <a href="{{ route('register') }}"
                   class="hidden md:inline-block bg-black text-white px-5 py-2.5 rounded-lg text-sm font-medium hover:bg-neutral-800 transition">
                    Get Started
                </a>
            @endguest

            @auth
                <div class="relative hidden md:block group">
                    <button class="flex items-center gap-2 text-sm font-medium hover:opacity-70 transition">
                        <span>{{ auth()->user()->name }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    {{-- Dropdown Minimalis --}}
                    <div class="absolute right-0 top-full mt-2 w-48 bg-white border border-neutral-200 rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right">
                        <div class="py-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-neutral-600 hover:bg-neutral-50 hover:text-black">
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth

            {{-- Mobile Menu Button (Hamburger) --}}
            <button class="md:hidden p-2 text-neutral-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </div>
</nav>