<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{ Html::favicon( '/assets/images/favicon.ico' ) }}
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}Admin - @yield('title')</title>

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
