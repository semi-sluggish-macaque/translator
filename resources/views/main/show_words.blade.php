@extends('layouts.layout')

@section('content')
    <style>
        .form-control {
            transition: width 0.5s ease-out;
            max-width: 350px;
        }

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
                            <li class="breadcrumb-item active">Show-words</li>
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
                                        <h3 class="card-title">Слова модуля: "{{$module[0]->module}}"</h3>

                                    </div>

                                    <a href="{{route('learn.words', ['id'=>$module[0]->id])}}">
                                        <button type="button" class="btn btn-block bg-gradient-secondary"
                                                style="max-width: 150px; margin-top: 15px; margin-left: 28px ">Учить
                                            слова
                                        </button>
                                        <div class="mt-4" style="color: gold; ">
                                            <a href="{{ route('show.module') }}" class="btn btn-primary">Домой</a>
                                        </div>
                                    </a>

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

                                                    {{--                                                    <input type="hidden" name="hidden_id" value="{{$item[2]}}">--}}
                                                    <input type="hidden"
                                                           name="data[{{ $index }}][2]"
                                                           value="{{ $item[2] }}">
                                                    <tr>
                                                        <td>
                                                            <textarea id="dataInput" class="form-control"
                                                                      style="max-width: 1920px;
                                                                       transition: height 0.3s ease-out;
                                                                        height: 50px;
                                                                        resize: none;
                                                                        white-space: pre-wrap;
                                                                        word-wrap: break-word;"
                                                                      name="data[{{ $index }}][0]">{!! $item[0] !!}</textarea>
                                                        </td>
                                                        <td> <textarea id="dataInput" class="form-control"
                                                                       style="max-width: 1920px;
                                                                        transition: height 0.3s ease-out;
                                                                        height: 50px;
                                                                        resize: none;
                                                                        white-space: pre-wrap;
                                                                        word-wrap: break-word;"
                                                                       name="data[{{ $index }}][1]">{!! $item[1] !!}</textarea>

                                                        </td>
                                                        <td class="delete-td">
                                                            <button class="btn btn-danger delete-row-btn" type="button">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="2">
                                                        <button class="btn btn-primary add-row-btn" type="button">
                                                            Добавить строку
                                                        </button>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <button class="btn btn-primary mb-1" type="button"
                                                    onclick="submitForm('{{ route('save.words') }}')">Cохранить
                                                данные
                                            </button>
                                            <button class="btn btn-primary mb-1" type="button"
                                                    onclick="submitForm('{{ route('print') }}')">Скачать word
                                                документ слов
                                            </button>
                                            <div class="mt-4" style="color: gold; ">
                                                <a href="{{ route('show.module') }}" class="btn btn-primary">Домой</a>
                                            </div>
                                        </div>

                                        <div class="card-footer">

                                        </div>
                                    </form>
                                    {{--                                    <a href="{{route('show.module')}}">--}}
                                    {{--                                        <button type="" class="btn btn-primary">Домой</button>--}}
                                    {{--                                    </a>--}}
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

        document.addEventListener('DOMContentLoaded', function () {
            const dataInputs = document.querySelectorAll('#dataInput');

            function resizeTextarea(event) {
                const target = event.target;
                const sibling = target.parentElement.nextElementSibling.querySelector('textarea') || target.parentElement.previousElementSibling.querySelector('textarea');
                if (target.scrollHeight > 50) {
                    target.style.height = target.scrollHeight + 'px';
                    sibling.style.height = target.style.height;
                } else {
                    target.style.height = '50px';
                    sibling.style.height = '50px';
                }
            }

            dataInputs.forEach(input => {
                input.addEventListener('input', resizeTextarea);
                input.addEventListener('focus', resizeTextarea);
                input.addEventListener('blur', function (event) {
                    event.target.style.height = '50px';
                    const sibling = event.target.parentElement.nextElementSibling.querySelector('textarea') || event.target.parentElement.previousElementSibling.querySelector('textarea');
                    sibling.style.height = '50px';
                });
            });
        });

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

                <input type="hidden" name="data[${number}][2]" value="null">
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
