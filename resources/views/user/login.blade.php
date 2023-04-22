@extends('layouts.home_layout')

@section('content')

    <style>
        .custom-translate-field {
            max-width: 600px;
        }

        .translate-custom {
            margin-top: 200px;
        }

        .from-text-register {
            display: none;
        }

        @media screen and (max-width: 1920px) {

            .custom-translate-field {
                max-width: 400px;
            }

            .translate-custom {
                margin-top: 75px;
            }
        }

        @media screen and (max-width: 725px) {

            .child_div {
                position: absolute;
                left: 50%;
                top: 30%;
                transform: translate(-50%, -50%);
            }


            .custom-translate-field {
                max-width: 250px;
            }

            .login_info {
                display: none;
            }

            .from-text-register {
                display: block;
            }
        }
    </style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        {{--            <section class="content">--}}
        {{--                <div class="container-fluid">--}}
        {{--                    <div class="row">--}}
        {{--                        <div class="col-12">--}}
        {{--                            <div class="card">--}}
        {{--                                <div class="card-header">--}}
        {{--                                    --}}{{--                                <h3 class="card-title">Список категорий</h3>--}}
        {{--                                </div>--}}
        {{--                                <!-- /.card-header -->--}}
        {{--                                <div class="card-body">--}}
        {{--                                    <div class="card card-primary">--}}
        <div class="card-body row">

            <div class="col-5 text-center d-flex align-items-center justify-content-center translate-custom">
                <div class="login_info">
                    <h1>Переводчик</h1>
                    <h2 class="lead mb-5">Чтобы начать пользоватся переводчиком<br>
                        <a href="{{route("register.create")}}">Зарегистрируйтесь</a> либо войдите в аккаунт!
                    </h2>
                </div>
            </div>
            <div class="col-7 translate-custom child_div">
                <form method="post" action="{{route('login.create')}}" enctype="multipart/form-data">

                    @csrf

                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control custom-translate-field" id="email" name="email"
                               value="{{old('email')}}">
                    </div>

                    <div class="form-group">
                        <label for="password">password</label>
                        <input type="password" class="form-control custom-translate-field" id="password"
                               name="password">
                    </div>
                    <p class="from-text-register"><a href="{{route("register.create")}}"> Зарегистрироватся</a></p>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Войти">
                    </div>
                </form>
            </div>
        </div>

        {{--                                    </div>--}}
        {{--                                </div>--}}

        {{--                            </div>--}}
        {{--                            <!-- /.card -->--}}

        {{--                        </div>--}}
        {{--                        <!-- /.col -->--}}
        {{--                    </div>--}}
        {{--                    <!-- /.row -->--}}
        {{--                </div><!-- /.container-fluid -->--}}
        {{--            </section>--}}
        <!-- /.content -->
    </div>

@endsection
