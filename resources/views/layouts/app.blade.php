<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0 mr-auto d-none d-lg-block">
            <img src="https://workers.swork.pt/logo.svg" class="logo" alt="logo">
        </div>
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
    </div>
    <div class="mr-auto order-0">
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <!-- <span class="navbar-toggler-icon"></span> -->
            <span class="navbar-toggler-icon-white">
                <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="MenuIcon"><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"></path></svg>
                </span>
                
        </button>
    </div>
    <div class="navbar-collapse collapse w-100 order-1 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Contatos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Login</a>
            </li>
        </ul>
    </div>
</nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
