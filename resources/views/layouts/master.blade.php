<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    @include('layouts.headerStyles')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        @include('layouts.main-headerbar')
        <div style="margin-left: 21%;margin-top:2%; color: darkblue">
            @yield('pageTitle')
        </div>

        <div style="width: 80%; height: 80vh; margin-left: 20%;">
            @yield('content')
        </div>

        @include('layouts.main-sidebar')

        @include('layouts.footer')
    </div>
    <!-- ./wrapper -->
    @include('layouts.footerScripts')
</body>

</html>
