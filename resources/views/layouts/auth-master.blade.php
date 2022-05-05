<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>Backpanel</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! url('assets/css/signin.css') !!}" rel="stylesheet"> -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{!! url('assets/AdminLTE/plugins/fontawesome-free/css/all.min.css') !!}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{!! url('assets/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') !!}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{!! url('assets/AdminLTE/dist/css/adminlte.min.css') !!}">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <!-- <link href="signin.css" rel="stylesheet"> -->
</head>

<body class="hold-transition login-page">

@yield('content')

<!-- jQuery -->
<script src="{!! url('assets/AdminLTE/plugins/jquery/jquery.min.js') !!}"></script>
<!-- Bootstrap 4 -->
<script src="{!! url('assets/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<!-- AdminLTE App -->
<script src="{!! url('assets/AdminLTE/dist/js/adminlte.min.js') !!}"></script>
</body>

</html>