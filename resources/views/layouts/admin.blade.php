<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/assets/images/favicon/site.webmanifest">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div id="app">
    <div class="admin">
        @include('layouts.partials.info')
        <side-bar-menu-admin
                route-dashboard="{{route('admin.dashboard')}}"
                route-scarves="{{route('admin.scarves.index')}}"
                route-logout="{{ route('logout') }}"
                route-show="{{ route('home') }}"
                user-name="{{ Auth::user()->name }}"
                csrf-token="{{ csrf_token() }}"
        ></side-bar-menu-admin>

        <main>
            <div class="admin-title">
                <h2>@yield('title')</h2>
            </div>
            <div class="admin-container">@yield('content')</div>
        </main>
    </div>
</div>
</body>
</html>
