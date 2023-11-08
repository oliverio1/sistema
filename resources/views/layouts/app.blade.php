<!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>
                @yield('title')
            </title>
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
            <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
            <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
            <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
            <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
            <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
            <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
            <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
            <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
            <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            {{-- Datatables --}}
            <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css"/>
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.6.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/datatables.min.css"/>
            {{-- Select2 --}}
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
            {{-- FullCalendar --}}
            <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/main.min.css') }}">
            @stack('third_party_stylesheets')
            @stack('page_css')
        </head>
        <body class="hold-transition sidebar-mini layout-fixed">
            <div class="wrapper">
                <div class="preloader flex-column justify-content-center align-items-center">
                    <img class="animation__shake" src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
                </div>
                <!-- Navbar -->
                @include('layouts.navbar')
                {{-- Sidebar --}}
                @include('layouts.sidebar')
                {{-- Content --}}
                <div class="content-wrapper">
                @yield('content')
                </div>
                {{-- Footer --}}
                <footer class="main-footer">
                    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
                    All rights reserved.
                    <div class="float-right d-none d-sm-inline-block">
                        <b>Version</b> 3.2.0
                    </div>
                </footer>
            </div>
            <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
            <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
            <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
            <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
            {{-- <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script> --}}
            {{-- <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> --}}
            <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
            <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
            <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
            <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
            <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
            <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
            <script src="{{ asset('dist/js/adminlte.js') }}"></script>
            {{-- <script src="{{ asset('dist/js/demo.js') }}"></script> --}}
            {{-- Datatables --}}
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.6.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/datatables.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
            {{-- Select2 --}}
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            {{-- FullCalendar --}}
            <script src="{{ asset('plugins/fullcalendar/main.min.js') }}"></script>
            @stack('third_party_scripts')
            @yield('page_scripts')
        </body>
    </html>
