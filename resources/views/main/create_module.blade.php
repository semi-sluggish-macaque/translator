@extends('layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Модули</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Modules</li>
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
                                        <h3 class="card-title">Создание Модуля</h3>
                                    </div>


                                    <form action="{{ route('create.module') }}" method="post"
                                          enctype="multipart/form-data">

                                        @csrf

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="title">Название</label>
                                                <input type="text"
                                                       class="form-control  @error('title') is-invalid @enderror"
                                                       id="text" name="text"
                                                       placeholder="Название модуля">
                                            </div>
                                        </div>

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Сохранить</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col -->
                </div>


                <div class="container-fluid">
                    <h5 class="mb-2">Мои модули</h5>
                    <div class="row">

                        @foreach($data as $module)
                            <div class="col-md-3 col-sm-6 col-12">
                                <a href="{{ route('show.words', ['id'=>$module->id]) }}">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">{{$module->module}}</span>
                                            <span class="info-box-number">{{$module->words_count}} слов</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach


                    </div>


                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
