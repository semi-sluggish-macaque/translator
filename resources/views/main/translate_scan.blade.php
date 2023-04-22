@extends('layouts.layout')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Сканер</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Scaner</li>
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
                                        <h3 class="card-title">Сканер</h3>
                                    </div>

                                    <form action="" method="post" enctype="multipart/form-data"
                                          id="upload-form">

                                        @csrf

                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="thumbnail">Вы можете вставить изображение с буфера
                                                        обмена(CTRL+V) либо нажать ниже и загрузить изображение</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" name="file" id="file"
                                                                   class="custom-file-input ">
                                                            <label class="custom-file-label" for="file">Загрузить
                                                                изображение</label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="display: block; margin: 0 auto;">
                                            <img id="pasted-image" src="#" alt=""
                                                 style="display:none; display: block; margin: 0 auto; "/></div>
                                        <div class="card-footer">
{{--                                            <button type="submit" class="btn btn-primary">Сохранить</button>--}}
                                            <button class="btn btn-primary mb-1" id="delete-image" type="button" style="display:none;">Удалить
                                                изображение
                                            </button>
                                            {{--                                            <button id="upload-image" type="button" style="display:none;">Отправить--}}
                                            {{--                                                изображение на сервер--}}
                                            {{--                                            </button>--}}

                                            <button class="btn btn-primary mb-1" id="upload-image" type="button"
                                                    onclick="submitForm('{{ route('upload') }}')"
                                                    style="display:none;">Отправить
                                                изображение на сервер
                                            </button>


                                            <button class="btn btn-primary mb-1"
                                                    id="plain-scan"type="button"
                                                    onclick="submitForm('{{ route('scan') }}')">
                                                Скан
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
        function submitForm(action) {
            var loader = document.getElementById("loader");
            loader.style.display = "block";

            const form = document.getElementById('upload-form');
            form.action = action;
            form.submit();
        }

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
                        const img = document.getElementById('pasted-image');
                        img.src = event.target.result;
                        img.style.display = 'block';

                        // Показать кнопки удаления и отправки изображения
                        document.getElementById('delete-image').style.display = 'block';
                        document.getElementById('upload-image').style.display = 'block';
                        document.getElementById('plain-scan').style.display = 'none';
                    };

                    reader.readAsDataURL(blob);

                }
            }
        });

        // Обработчик события удаления изображения
        document.getElementById('upload-image').addEventListener('click', async function () {
            const img = document.getElementById('pasted-image');

            // Преобразование Data URL (base64) в Blob
            const response = await fetch(img.src);
            const blob = await response.blob();

            const formData = new FormData();
            formData.append('image', blob, 'pasted-image.png'); // Здесь вы можете изменить имя файла, если хотите

            // Найти форму
            const form = document.getElementById('upload-form');

            // Добавьте скрытый input с данными изображения в форму
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'pastedImage';
            form.appendChild(input);

            // Записать данные изображения в скрытый input
            const reader = new FileReader();
            reader.onload = function () {
                input.value = reader.result;

                // Отправить форму
                form.submit();
            };
            reader.readAsDataURL(blob);
        });
        document.getElementById('delete-image').addEventListener('click', function () {
            const img = document.getElementById('pasted-image');
            img.src = '#';
            img.style.display = 'none';

            // Скрыть кнопки удаления и отправки изображения
            this.style.display = 'none';
            document.getElementById('upload-image').style.display = 'none';
            document.getElementById('plain-scan').style.display = 'block';

        });
    </script>
@endsection
