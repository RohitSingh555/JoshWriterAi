<script src="{{ asset('admin') }}/plugins/jquery/jquery.min.js"></script>

    <script src="{{ asset('admin') }}/plugins/jquery-ui/jquery-ui.min.js"></script>

    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <script src="{{ asset('admin') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('admin') }}/plugins/chart.js/Chart.min.js"></script>

    <script src="{{ asset('admin') }}/plugins/sparklines/sparkline.js"></script>

    <script src="{{ asset('admin') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

    <script src="{{ asset('admin') }}/plugins/jquery-knob/jquery.knob.min.js"></script>

    <script src="{{ asset('admin') }}/plugins/moment/moment.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/daterangepicker/daterangepicker.js"></script>

    <script src="{{ asset('admin') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

    <script src="{{ asset('admin') }}/plugins/summernote/summernote-bs4.min.js"></script>

    <script src="{{ asset('admin') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

    <script src="{{ asset('admin') }}/dist/js/adminlte2167.js?v=3.2.0"></script>


    <script src="{{ asset('admin') }}/dist/js/pages/dashboard.js"></script>
    <script>
        @if(Session::has('success'))
        toastr.options = {
            "closeButton": true
            , "progressBar": true
        }
        toastr.success("{{ session('success') }}");
        @endif

    </script>
<script>
    @if(Session::has('error'))
    toastr.options = {
        "closeButton": true
        , "progressBar": true
    }
    toastr.error("{{ session('error') }}");
    @endif

</script>
