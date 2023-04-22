@extends('layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        {{--                        <h1>Категории</h1>--}}
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Blank Page</li>
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
                                        <h3 class="card-title">Перевод текста</h3>
                                    </div>


                                    <form action="{{ route('posts.storePlain') }}" method="post" enctype="multipart/form-data">

                                        @csrf

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="title">Введитe текс, который хотите перевести</label>
                                                <input type="text"
                                                       class="form-control  @error('title') is-invalid @enderror"
                                                       id="text" name="text"
                                                       placeholder="Ваши слова">
                                                <div class="form-group">
                                                    <label for="select2">Выберите вариант</label>
                                                    <select class="form-control" id="select2" name="select2">
                                                        <option value="russian">Русский</option>
                                                        <option value="ukrainian">Украинский</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Перевести</button>
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

@endsection
