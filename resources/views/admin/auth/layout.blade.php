<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@php($name = 'teste')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="@yield('author', __('kuber::admin/auth/auth.author'))">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('description', __('kuber::admin/auth/auth.description'))">
    <link rel="canonical" href="{{ request()->url() }}" >
    <link rel="icon" href="@yield('favicon', asset('vendor/kuber/images/favicon.webp'))">

    <meta name="robots" content="@yield('robots', 'noindex, nofollow')">

    {{-- Title --}}
    <title>
        @yield('title', __('kuber::admin/auth/auth.title'))
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
