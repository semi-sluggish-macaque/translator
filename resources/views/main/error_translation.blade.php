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
                            <li class="breadcrumb-item active">Error</li>
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
                                        <h3 class="card-title">Результат перевода</h3>
                                    </div>

                                    <div class="container mt-5">

                                        <p style="color: #d30a0a; font-size: 80px; text-align: center;">Произошла
                                            ошибка!!!</p>
                                        <p style="color: red; font-size: 50px;text-align: center;">Текст показан в
                                            "сыром виде"</p>
                                        <p style="color: red; font-size: 30px;text-align: center;">Измените вводимые
                                            данные либо попробуйте еще раз</p>

                                        @php   echo '<pre>' . print_r($answer, 1) . '</pre>'; @endphp

                                        <div class="mt-4">
                                            <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
                                        </div>
                                    </div>

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
            const form = document.getElementById('dataForm');
            form.action = action;
            form.submit();
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelector('body').addEventListener('click', function (event) {
                if (event.target.classList.contains('delete-row-btn')) {
                    event.target.closest('tr').remove();
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            document.body.addEventListener('click', function (event) {
                if (event.target && event.target.classList.contains('add-row-btn')) {
                    const formControls = document.querySelectorAll('.form-control');
                    const lastElementName = formControls[formControls.length - 1].getAttribute('name');
                    const nameAttr = lastElementName;
                    const regex = /data\[(\d+)\]\[\d+\]/;
                    const match = nameAttr.match(regex);

                    let number;

                    if (match) {
                        number = parseInt(match[1], 10) + 1;
                        console.log("Extracted number:", number);
                    } else {
                        console.log("No match found");
                        return;
                    }

                    const newRow = document.createElement('tr');
                    newRow.innerHTML = `

                <td><input class="form-control" type="text" name="data[${number}][0]"></td>
                <td><input class="form-control" type="text" name="data[${number}][1]"></td>
                <td style="max-width: 50px"><button class="btn btn-danger delete-row-btn" type="button">Удалить</button></td>
            `;

                    event.target.closest('tr').insertAdjacentElement('beforebegin', newRow);
                }
            });
        });


    </script>
@endsection
