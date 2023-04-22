@extends('layouts.layout')

@section('content')
    <style>

        .delete-td {
            max-width: 50px;
        }

        .phone_view {
            display: none;
        }

        @media screen and (max-width: 1920px) {


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
                        {{--                        <h1>Категории</h1>--}}
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Show-translation</li>
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

                                    <p class="phone_view">
                                    <h2 class="phone_view">Переверните смартфон для лучшего отображения</h2>
                                    </p>
                                    <form id="dataForm" method="POST">


                                        @csrf

                                        <div class="card-body">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Word or phrase</th>
                                                    <th scope="col">Translation</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($answer as $index => $item)

                                                    <tr>
                                                        <td><input class="form-control" type="text"
                                                                   name="data[{{ $index }}][0]"
                                                                   value="{{ $item[0] }}"></td>
                                                        <td><input class="form-control" type="text"
                                                                   name="data[{{ $index }}][1]"
                                                                   value="{{ $item[1] }}"></td>


                                                        <td class="delete-td">
                                                            <button class="btn btn-danger delete-row-btn" type="button">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="3">
                                                        <button class="btn btn-primary add-row-btn" type="button">
                                                            Добавить строку
                                                        </button>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <button class="btn btn-primary mb-1" type="button"
                                                    onclick="submitForm('{{ route('save.array') }}')">
                                                Cохранить
                                                данные
                                            </button>
                                            <button class="btn btn-primary mb-1" type="button"
                                                    onclick="submitForm('{{ route('print') }}')">Скачать word
                                                документ слов
                                            </button>
                                        </div>

                                        <div class="mt-4" style="color: gold; ">
                                            <a href="{{ route('show.module') }}" class="btn btn-primary">Домой</a>
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
                <td class="delete-td">
                                                            <button class="btn btn-danger delete-row-btn" type="button">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </td>
            `;

                    event.target.closest('tr').insertAdjacentElement('beforebegin', newRow);
                }
            });
        });


    </script>
@endsection
