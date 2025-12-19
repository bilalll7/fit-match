@if (session('success'))
<div
    x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => show = false, 3000)"
    x-transition:enter="transition transform ease-out duration-300"
    x-transition:enter-start="translate-y-6 opacity-0"
    x-transition:enter-end="translate-y-0 opacity-100"
    x-transition:leave="transition transform ease-in duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed top-6 right-6 bg-green-500 text-white px-6 py-4 rounded-xl shadow-lg z-50"
>
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div
    x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => show = false, 4000)"
    x-transition:enter="transition transform ease-out duration-300"
    x-transition:enter-start="translate-y-6 opacity-0"
    x-transition:enter-end="translate-y-0 opacity-100"
    x-transition:leave="transition transform ease-in duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed top-6 right-6 bg-red-500 text-white px-6 py-4 rounded-xl shadow-lg z-50"
>
    {{ session('error') }}
</div>
@endif
