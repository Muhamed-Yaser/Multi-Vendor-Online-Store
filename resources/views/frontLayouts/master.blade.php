<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
<title>@yield('title')</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assetsFront/images/favicon.svg')}}" />
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        @include('layouts.main-headerbar')
        {{-- <div style="margin-left: 21%;margin-top:2%; color: darkblue"> --}}
            @yield('pageTitle')
        {{-- </div> --}}

        {{-- <div style="width: 80%; height: 80vh; margin-left: 20%;"> --}}
            @yield('content')
        {{-- </div> --}}

        @include('layouts.main-sidebar')

        @include('layouts.footer')
    </div>
    <!-- ./wrapper -->
    @include('layouts.footerScripts')
</body>

</html>
