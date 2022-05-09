<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ Config::get('app.name') }} | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{!! url('assets/AdminLTE/plugins/fontawesome-free/css/all.min.css') !!}">
    <!-- Toast Alert/Modal -->
    <link rel="stylesheet" href="{!! url('assets/AdminLTE/plugins/toastr/toastr.min.css') !!}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{!! url('assets/AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') !!}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{!! url('assets/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') !!}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{!! url('assets/AdminLTE/plugins/jqvmap/jqvmap.min.css') !!}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{!! url('assets/AdminLTE/dist/css/adminlte.min.css') !!}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{!! url('assets/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') !!}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{!! url('assets/AdminLTE/plugins/daterangepicker/daterangepicker.css') !!}">
    <!-- summernote -->
    <link rel="stylesheet" href="{!! url('assets/AdminLTE/plugins/summernote/summernote-bs4.min.css') !!}">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php
        if (!empty(request()->route()->getName())) {
            $routes = explode('.', request()->route()->getName());
            $module = !empty($routes[0]) ? $routes[0] : "";
            $page = !empty($routes[1]) ? $routes[1] : "";
        }
        ?>
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{!! url('assets/AdminLTE/dist/img/AdminLTELogo.png') !!}" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->


        @include('layouts.partials.top-bar')
        <!-- /.navbar -->

        @include('layouts.partials.main-sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">



            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">{{ ucfirst($module) }}</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                <li class="breadcrumb-item active">{{ ucfirst($module) }}</li>
                                <li class="breadcrumb-item active">{{ $page }}</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                @include('layouts.partials.messages')

                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @include('layouts.partials.admin-footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    
    @include('layouts.partials.scripts')

    @yield('scripts')
</body>

</html>