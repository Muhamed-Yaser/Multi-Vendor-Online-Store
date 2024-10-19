<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

<script>
    const adminID = {{ auth()->guard('admin')->user()->id }};
    console.log(adminID);
</script>
<script src="{{ asset('js/notification.js') }}"></script>
@vite('resources/js/notification.js')

@yield('scripts')
