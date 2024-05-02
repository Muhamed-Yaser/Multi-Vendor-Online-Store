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

        @include('layouts.main-sidebar')

        @yield('content')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        @include('layouts.footer')
    </div>
    <!-- ./wrapper -->
    @include('layouts.footerScripts')
</body>

</html>
