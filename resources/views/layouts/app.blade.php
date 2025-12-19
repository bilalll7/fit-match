<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FitMatch</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- PRECONNECT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- PRELOAD FONT (ANTI LOMPAT) -->
    <link
        rel="preload"
        as="style"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        onload="this.onload=null;this.rel='stylesheet'">

    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    </noscript>

    @vite('resources/css/app.css')
</head>

<body class="font-sans bg-white text-gray-900">

    @include('partials.navbar')
    @include('partials.sweetalert')
@stack('scripts')

{{-- @include('partials.alert') --}}

<main
class="pt-20"
    x-data="{ loaded: false }"
    x-init="setTimeout(() => loaded = true, 100)"
    x-show="loaded"
    x-transition.opacity.duration.500ms
>
    @yield('content')
</main>



</body>

</html>
