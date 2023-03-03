<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="@yield('author', 'Carlos Alexandre')">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('description', 'Página administrativa')">
    <link rel="canonical" href="{{ request()->url() }}" >
    <link rel="icon" href="@yield('favicon', asset('vendor/kuber/images/favicon.webp'))">

    <meta name="robots" content="@yield('robots', 'noindex, nofollow')">

    {{-- Title --}}
    <title>
        @yield('title', 'Página Administrativa')
    </title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('vendor/kuber/css/admin/auth/layout.css') }}">
    @yield('css')

    @production
        <!-- Global site tag (gtag.js) - Google Analytics -->

        <!-- AdSense -->
    @endproduction

</head>

<body>
    <main id="root">
        @yield('body')
    </main>
</body>

</html>
