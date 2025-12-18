<nav class="fixed top-0 left-0 w-full h-20 bg-white border-b z-50">

    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">

        {{-- LOGO --}}
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
                OuT
            </div>
            <span class="font-semibold text-lg">FitMatch</span>
        </div>

        {{-- DESKTOP MENU --}}
        <div class="hidden md:flex items-center gap-8 text-sm font-medium">
            <a href="{{ route('home') }}"
               class="{{ request()->routeIs('home') ? 'text-green-600' : 'text-gray-600 hover:text-gray-900' }}">
                Dashboard
            </a>

            <a href="{{ auth()->check() ? route('outfits.index') : route('login') }}"
               class="text-gray-600 hover:text-gray-900">
                Match Your Outfit
            </a>

            <a href="{{ auth()->check() ? '#' : route('login') }}"
               class="text-gray-600 hover:text-gray-900">
                Find Your Outfit
            </a>
        </div>

        {{-- RIGHT SIDE --}}
        <div class="flex items-center gap-3">

            {{-- DESKTOP AUTH --}}
            @guest
                <a href="{{ route('login') }}"
                   class="hidden md:inline border border-green-500 text-green-600 px-4 py-2 rounded-full text-sm">
                    Login
                </a>
            @endguest

@auth
    <details class="hidden md:block relative">
        <summary
            class="list-none cursor-pointer flex items-center gap-2 border border-green-500 text-green-600 px-4 py-2 rounded-full text-sm">
            <span>{{ auth()->user()->name }}</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 9l-7 7-7-7"/>
            </svg>
        </summary>

        <div class="absolute right-0 mt-2 w-40 bg-white border rounded-lg shadow-lg">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    type="submit"
                    class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100">
                    Logout
                </button>
            </form>
        </div>
    </details>
@endauth


            {{-- MOBILE MENU --}}
            <details class="md:hidden relative">
                <summary class="list-none cursor-pointer">
                    <svg class="w-7 h-7 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </summary>

                <div class="absolute right-0 mt-3 w-52 bg-white border rounded-xl shadow-lg">
                    <a href="{{ route('home') }}"
                       class="block px-4 py-3 text-sm hover:bg-gray-100">
                        Dashboard
                    </a>

                    <a href="{{ auth()->check() ? route('outfits.index') : route('login') }}"
                       class="block px-4 py-3 text-sm hover:bg-gray-100">
                        Match Your Outfit
                    </a>

                    <a href="{{ auth()->check() ? '#' : route('login') }}"
                       class="block px-4 py-3 text-sm hover:bg-gray-100">
                        Find Your Outfit
                    </a>

                    <hr>

                    @guest
                        <a href="{{ route('login') }}"
                           class="block px-4 py-3 text-sm text-green-600 hover:bg-gray-100">
                            Login
                        </a>
                    @endguest

                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button
                                class="w-full text-left px-4 py-3 text-sm hover:bg-gray-100">
                                Logout
                            </button>
                        </form>
                    @endauth
                </div>
            </details>
        </div>
    </div>
</nav>
