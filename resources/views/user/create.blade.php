@extends('layouts.home_layout')

@section('content')

    <style>
        .custom-translate-field {
            max-width: 600px;

        }

        .translate-custom {
            margin-top: 100px;
        }

        @media screen and (max-width: 1920px) {

            .custom-translate-field {
                max-width: 400px;
            }

            .translate-custom {
                margin-top: 0px;
            }

            .from-text-login {
                display: none;
            }
        }

        @media screen and (max-width: 725px) {

            .child_div {
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
            }


            .custom-translate-field {
                max-width: 250px;
            }

            .register_info {
                display: none;
            }

            .from-text-login {
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
            {{--                <div class="row">--}}
            {{--                    <div class="col-12">--}}
            {{--                        @if ($errors->any())--}}
            {{--                            <div class="alert alert-danger">--}}
            {{--                                чтобы ошибки были без маркера валидационного списка--}}
            {{--                                <ul class="list-unstyled">--}}
            {{--                                    @foreach ($errors->all() as $error)--}}
            {{--                                        <li>{{ $error }}</li>--}}
            {{--                                    @endforeach--}}
            {{--                                </ul>--}}
            {{--                            </div>--}}
            {{--                        @endif--}}
            {{--                        @if (session()->has('success'))--}}
            {{--                            <div class="aelrt alert-success"></div>--}}
            {{--                            {{session('success')}}--}}
            {{--                        @endif--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            <div class="col-5 text-center d-flex align-items-center justify-content-center translate-custom">
                <div class="register_info">
                    <h1>Переводчик</h1>
                    <h2 class="lead mb-5">Чтобы начать пользоватся переводчиком<br>
                        Зарегистрируйтесь либо <a href="{{route("login.create")}}">войдите в аккаунт</a>!
                    </h2>
                </div>
            </div>
            <div class="col-7 translate-custom child_div">
                <form method="post" action="{{route('register.store')}}" enctype="multipart/form-data">

                    @csrf

                    <div class="form-group custom-translate-field">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control custom-translate-field "
                               value="{{old('name')}}">
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">E-Mail</label>
                        <input type="email" id="email" name="email" class="form-control custom-translate-field"
                               value="{{old('email')}}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password"
                               class="form-control custom-translate-field">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="form-control custom-translate-field">
                    </div>
                    <p class="from-text-login"><a href="{{route("login")}}"> Войти в акккаунт</a></p>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Зарегистрироваться">
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
