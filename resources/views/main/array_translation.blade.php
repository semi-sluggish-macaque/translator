@extends('layouts.layout')

@section('content')

    <style>
        .textarea-custom {
        }

        @media screen and (max-width: 1920px) {
            .textarea-custom{}

        }

        @media screen and (max-width: 725px) {
            .phone_view {
                display: block;
            }

        }
    </style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Перевод</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Translation</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                {{--                                <h3 class="card-title">Список категорий</h3>--}}
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Перевод </h3>
                                    </div>


                                    <form method="post" id="upload-form" enctype="multipart/form-data">

                                        @csrf

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="title">Введитe слова либо текст, которые хотит
                                                    перевести</label>
                                                <textarea id="dataInput" class="form-control textarea-custom"
                                                          style="max-width: 1920px;
                                                                        height: 250px;
                                                                        /*resize: none;*/
                                                                        white-space: pre-wrap;
                                                                        word-wrap: break-word;
                                                                        "
                                                          name="data"></textarea>

                                                <div class="form-group">
                                                    <label for="select">Выберите в какой модуль сохранить</label>
                                                    <select class="form-control" id="selectModule" name="selectModule">
                                                        @foreach ($answer as $item)
                                                            <option value="{{$item[0]}}">{{$item[1]}}</option>
                                                        @endforeach

                                                    </select>
                                                    <label for="select">Выберите вариант</label>
                                                    <select class="form-control" id="select" name="select">
                                                        <option value="1">С примером использования</option>
                                                        <option value="2">Без примера использования</option>
                                                        <option value="3">Перевести как текст</option>
                                                    </select>
                                                    <label for="select2">Выберите вариант</label>
                                                    <select class="form-control" id="select2" name="select2">
                                                        <option value="russian">Русский</option>
                                                        <option value="ukrainian">Украинский</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary"
                                                    onclick="submitForm('{{ route('array.translate') }}')">Перевести
                                            </button>
                                            {{--                                            <button type="submit" class="btn btn-primary" >Перевести</button>--}}
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <script>
        function submitForm(action) {
            var loader = document.getElementById("loader");
            loader.style.display = "block";

            const form = document.getElementById('upload-form');
            form.action = action;
            form.submit();
        }
    </script>
@endsection
