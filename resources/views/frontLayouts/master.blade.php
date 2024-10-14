<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>@yield('title')</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assetsFront/images/favicon.svg') }}" />
    @include('frontLayouts.headerStyles')
    @vite('resources/css/app.css')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        @include('frontLayouts.main-headerbar')

        @yield('pageTitle')
        @yield('content')
        {{-- @include('layouts.main-sidebar') --}}

        @include('frontLayouts.footer')
    </div>
    <!-- ./wrapper -->
    @include('frontLayouts.footerScripts')
</body>

</html>
