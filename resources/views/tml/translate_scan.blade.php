@extends('layouts.layout')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Категории</h1>
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
                                        <h3 class="card-title">Создание Модуля</h3>
                                    </div>

                                    <form action="{{ route('upload') }}" method="post"
                                          enctype="multipart/form-data">

                                        @csrf

                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="thumbnail">Изображение</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" name="file" id="file"
                                                                   class="custom-file-input ">
                                                            <label class="custom-file-label" for="file">Choose
                                                                file</label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="display: block; margin: 0 auto;">
                                            <img id="pasted-image" src="#" alt="Pasted image"
                                                 style="display:none; display: block; margin: 0 auto; "/></div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Сохранить</button>
                                            <button id="delete-image" type="button" style="display:none;">Удалить
                                                изображение
                                            </button>
                                            <button id="upload-image" type="button" style="display:none;">Отправить
                                                изображение на сервер
                                            </button>

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
        document.addEventListener('paste', function (event) {
            const items = (event.clipboardData || event.originalEvent.clipboardData).items;

            for (let i = 0; i < items.length; i++) {
                const item = items[i];
                if (item.kind === 'file' && item.type.startsWith('image/')) {
                    const blob = item.getAsFile();
                    const reader = new FileReader();

                    reader.onload = function (event) {
                        const img = document.getElementById('pasted-image');
                        img.src = event.target.result;
                        img.style.display = 'block';
                    };

                    reader.onload = function (event) {
                        console.log(111)
                        const img = document.getElementById('pasted-image');
                        img.src = event.target.result;
                        img.style.display = 'block';

                        // Показать кнопки удаления и отправки изображения
                        document.getElementById('delete-image').style.display = 'block';
                        document.getElementById('upload-image').style.display = 'block';
                    };

                    reader.readAsDataURL(blob);

                }
            }
        });

        // Обработчик события удаления изображения
        document.getElementById('delete-image').addEventListener('click', function () {
            const img = document.getElementById('pasted-image');
            img.src = '#';
            img.style.display = 'none';

            // Скрыть кнопки удаления и отправки изображения
            this.style.display = 'none';
            document.getElementById('upload-image').style.display = 'none';
        });

        document.getElementById('upload-image').addEventListener('click', async function () {
            const img = document.getElementById('pasted-image');

            // Преобразование Data URL (base64) в Blob
            const response = await fetch(img.src);
            const blob = await response.blob();

            const formData = new FormData();
            formData.append('image', blob, 'pasted-image.png'); // Здесь вы можете изменить имя файла, если хотите

            // Найти форму и добавить новые данные
            const form = document.getElementById('upload-form');
            form.appendChild(formData);

            // Отправить форму
            form.submit();
        });
    </script>
@endsection
