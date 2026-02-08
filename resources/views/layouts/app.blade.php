<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Miro - Lighting Solutions')</title>
    @stack('meta')
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
    @stack('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="antialiased">
    <!-- Header Container -->
    <div id="header-root"></div>
    
    <main>
        @yield('content')
    </main>
    
    <!-- Footer Container -->
    <div id="footer-root"></div>
</body>
</html> 