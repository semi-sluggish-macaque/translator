<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Blank Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/assets/admin/css/admin.css') }}">
    <script src="https://kit.fontawesome.com/2824c3e17f.js" crossorigin="anonymous"></script>
    <style>
        .ck-editor__editable_inline {
            min-height: 300px;
        }
    </style>
    <style>
        .adaptive-input {
            max-width: 1920px;
            height: 500px;
            resize: none;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        @media (max-width: 575px) {
            .adaptive-input {
                width: 100%;
                height: auto;
            }
        }

        .ck-editor__editable_inline {
            min-height: 300px;
        }


        .loader {
            border: 8px solid #f3f3f3;
            border-radius: 50%;
            border-top: 8px solid #3498db;
            width: 60px;
            height: 60px;
            animation: spin 2s linear infinite;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            background-color: rgba(255, 255, 255, 0.8);
            display: none;
        }

        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

    </style>
</head>
<div id="loader" class="loader">
</div>
<body class="hold-transition sidebar-mini">


<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" data-enable-remember="true" href="#" role="button"><i
                        class="fas fa-bars"></i></a>
            </li>

        </ul>


    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('show.module') }}" target="_blank" class="brand-link">
            <img src="{{ asset('public/assets/admin/img/AdminLTELogo.png') }}"
                 alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">На сайт</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('public/assets/admin/img/user2-160x160.jpg') }}"
                         class="img-circle elevation-2"
                         alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{auth()->user()->name}}</a>
                    <a href="{{route('logout')}}" class="nav-link">Выйти</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">
                        <a href="{{route('show.module')}}" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Модули
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('array.translation')}}" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Перевод
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('scan.translation')}}" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Сканер
                            </p>
                        </a>
                    </li>

                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <div class="container">
        <div class="row">
            <div class="col-12">

                @if (session()->has('success'))
                    <div class="alert alert-success"></div>
                    {{session('success')}}
                @endif @if (session()->has('errors'))
                    <div class="alert alert-danger"></div>
                    {{session('errors')}}
                @endif
            </div>
        </div>
    </div>


    <!-- Content Wrapper. Contains page content -->
    @yield('content')
    <!-- /.content-wrapper -->


    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.0.5
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script src="{{ asset('public/assets/admin/js/admin.js') }}"></script>
<script>


    $('.nav-sidebar a').each(function () {
        let location = window.location.protocol + '//' + window.location.host + window.location.pathname;
        let link = this.href;
        if (link == location) {
            $(this).addClass('active');
            $(this).closest('.has-treeview').addClass('menu-open');
        }
    });

    $(document).ready(function () {
        bsCustomFileInput.init();
    });



</script>

</body>
</html>
