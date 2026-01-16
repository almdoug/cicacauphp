<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', 'Conheça o CI Cacau — o portal de inteligência e inovação sobre a cadeia produtiva do cacau no Brasil. Dados, pesquisas, mercado, cursos e notícias atualizadas.')">

    <title>@yield('meta_title', 'CI Cacau | Centro de Inteligência da Cadeia Produtiva do Cacau')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('head-scripts')
</head>
<body class="font-sans antialiased bg-white">
    @include('components.navbar')

    <main>
        @yield('content')
    </main>

    @include('components.footer')
    
    @stack('scripts')
</body>
</html>
