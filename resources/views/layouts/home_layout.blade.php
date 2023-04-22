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
    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
        }

        .floating-card {
            position: fixed;
            top: 150px;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
        }
    </style>
</head>
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
{{--            <li class="nav-item d-none d-sm-inline-block">--}}
{{--                <a href="../../index3.html" class="nav-link">Выйти</a>--}}
{{--            </li>--}}
{{--            <li class="nav-item d-none d-sm-inline-block">--}}
{{--                <a href="{{route('posts.show')}}" class="nav-link">Войти</a>--}}
{{--            </li>--}}
{{--            <li class="nav-item d-none d-sm-inline-block">--}}
{{--                <a href="{{route('posts.show')}}" class="nav-link">Регистрация</a>--}}
{{--            </li>--}}
        </ul>


    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" target="" class="brand-link">
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
                    <img src="{{ asset('public/assets/admin/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                         alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">Имя</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Модули
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Перевод
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
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
                {{--                @if ($errors->any())--}}
                {{--                    <div class="alert alert-danger">--}}
                {{--                        --}}{{--чтобы ошибки были без маркера валидационного списка--}}
                {{--                        <ul class="list-unstyled">--}}
                {{--                            @foreach ($errors->all() as $error)--}}
                {{--                                <li>{{ $error }}</li>--}}
                {{--                            @endforeach--}}
                {{--                        </ul>--}}
                {{--                    </div>--}}
                {{--                @endif--}}
                {{--                @if (session()->has('success'))--}}
                {{--                    <div class="alert alert-success"></div>--}}
                {{--                    {{session('success')}}--}}
                {{--                @endif @if (session()->has('errors'))--}}
                {{--                    <div class="alert alert-danger"></div>--}}
                {{--                    {{session('errors')}}--}}
                {{--                @endif--}}
            </div>
        </div>
    </div>
    {{--    <div class="card-body row">--}}
    {{--        --}}
    {{--    </div>--}}
    <!-- Content Wrapper. Contains page content -->
    {{--    <div class="col-md-3 floating-card">--}}
    {{--        <div class="card bg-danger">--}}
    {{--            <div class="card-header">--}}
    {{--                <h3 class="card-title">Danger</h3>--}}
    {{--            </div>--}}
    {{--            <div class="card-body">--}}
    {{--                @if (session()->has('success'))--}}
    {{--                    <p class="aelrt alert-success"></p>--}}
    {{--                    {{session('success')}}--}}
    {{--                @endif--}}
    {{--                @if (session()->has('success'))--}}
    {{--                    <p class="aelrt alert-success"></p>--}}
    {{--                    {{session('success')}}--}}
    {{--                @endif--}}
    {{--                @if ($errors->any())--}}
    {{--                    <ul class="list-unstyled">--}}
    {{--                        @foreach ($errors->all() as $error)--}}
    {{--                            <li>{{ $error }}</li>--}}
    {{--                        @endforeach--}}
    {{--                    </ul>--}}
    {{--                @endif--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}


    @if ($errors->any())
        <div class="col-md-3 floating-card">
            <div class="card bg-danger">
                <div class="card-header">
                    <h3 class="card-title">Ошикба</h3>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="col-md-3 floating-card">
            <div class="card bg-danger">
                <div class="card-header">
                    <h3 class="card-title">Ошикба</h3>
                </div>
                <div class="card-body">
                    {{session('error')}}
                </div>
            </div>
        </div>
    @endif


    @if (session()->has('success'))
        <div class="col-md-3 floating-card">
            <div class="card bg-success">
                <div class="card-header">
                    <h3 class="card-title">Успех</h3>
                </div>
                <div class="card-body">
                    {{session('success')}}
                </div>
            </div>
        </div>
    @endif


    {{--    <div class="container">--}}
    {{--        <div class="row">--}}
    {{--            <div class="col-12">--}}
    {{--                @if ($errors->any())--}}
    {{--                    <div class="alert alert-danger">--}}
    {{--                        --}}{{--чтобы ошибки были без маркера валидационного списка--}}
    {{--                        <ul class="list-unstyled">--}}
    {{--                            @foreach ($errors->all() as $error)--}}
    {{--                                <li>{{ $error }}</li>--}}
    {{--                            @endforeach--}}
    {{--                        </ul>--}}
    {{--                    </div>--}}
    {{--                @endif--}}
    {{--                @if (session()->has('success'))--}}
    {{--                    <div class="aelrt alert-success"></div>--}}
    {{--                    {{session('success')}}--}}
    {{--                @endif--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}



    @yield('content')
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.0.5
        </div>
        <strong>Copyright &copy; 2023-2023 <a href="https://music.youtube.com/watch?v=YblQT-68RpU&list=LM">Чёрный
                умер</a>.</strong> Niggers have no rights .
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
<script src="https://ckeditor.com/apps/ckfinder/3.5.0/ckfinder.js"></script>

<script src="{{asset("public/assets/admin/ckeditor5/build/ckeditor.js")}}">
    <script src="{{asset("public/assets/admin/ckfinder/ckfinder.js")}}">
</script>
<script>
    ClassicEditor
        .create(document.querySelector('#content'), {
            ckfinder: {
                uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
            },
            image: {
                // You need to configure the image toolbar, too, so it uses the new style buttons.
                toolbar: ['imageTextAlternative', '|', 'imageStyle:alignLeft', 'imageStyle:full', 'imageStyle:alignRight'],

                styles: [
                    // This option is equal to a situation where no style is applied.
                    'full',

                    // This represents an image aligned to the left.
                    'alignLeft',

                    // This represents an image aligned to the right.
                    'alignRight'
                ]
            },
            toolbar: {
                items: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'link',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'indent',
                    'outdent',
                    'alignment',
                    '|',
                    'blockQuote',
                    'insertTable',
                    'undo',
                    'redo',
                    'CKFinder',
                    'mediaEmbed'
                ]
            },
            language: 'ru',
            table: {
                contentToolbar: [
                    'tableColumn',
                    'tableRow',
                    'mergeTableCells'
                ]
            },
        })
        .catch(function (error) {
            console.error(error);
        });

    ClassicEditor
        .create(document.querySelector('#description'), {
            toolbar: ['heading', '|', 'bold', 'italic', '|', 'undo', 'redo']
        })
        .catch(function (error) {
            console.error(error);
        });
</script>

</body>
</html>
