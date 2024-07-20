<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link rel="stylesheet" href="{{asset('fonts.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- Scripts -->
    
    <style>
        .error{
        color: #FF0000; 
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div id="app">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
          @include('layouts.header')
            <!-- /.navbar -->
            <!-- Main Sidebar Container -->
            @include('layouts.sidebar')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('content')
                @yield('admimHome')
            </div>
            <!-- /.content-wrapper -->
            @include('layouts.footer')
        </div>

        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
     <!-- Bootstrap 4 -->
    <script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin-assets/js/adminlte.min.js') }}"></script>
    <!-- <script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script> -->
    <script src="{{asset('js/sweetalert2.min.js')}}"></script>
    <script src="{{asset('js/jquery.validate.min.js')}}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    </script>   
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('admin-assets/js/demo.js') }}"></script>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    
    {{-- datatable --}}
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    @yield('customejs')
</body>
</html>
