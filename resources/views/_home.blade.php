<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">


    <!-- Favicons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="apple-touch-icon" href="/docs/5.3/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.3/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.3/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#712cf9">
    {{--возможность добавлять кастомныйц title--}}
    <title>@section('title')
            Перевiдчик
        @show</title>
    {{--    <link href="/css/main.css" rel="stylesheet">--}}
    <link href="/css/main.css">

    <style>

    </style>


</head>
<body>
<div class="container">

    @guest
        <p style="color: #d3900a; font-size: 80px; text-align: center;">Перевiдчик</p>
        <p style="color: red; font-size: 50px;">Привет, чтобы начать польоватся перевiдчиком, зарегистрируйтесь</p>
        <p style="color: red; font-size: 50px;">Переводчик позволяет скинировать текст и переводить содержимое, за раз можно перевети большой массив слов.</p>
        <p style="color: red; font-size: 50px;">Также вы можете учить слова по карточкам и многое другое!</p>
        <a href="{{route('register.create')}}">
            <button class="btn btn-danger" style="font-size: 80px;">Регистрация</button>
        </a>
        <a href="{{route('login.create')}}">
            <button class="btn btn-danger" style="font-size: 80px;">Авторизация</button>
        </a>
    @endguest

    @auth
        <p style="color: #d3900a; font-size: 80px; text-align: center;">Перевiдчик</p>
        <p style="color: red; font-size: 50px;">Не стоит отправлять слишком много текста!!!</p>
        <p style="color: red; font-size: 30px;">Это может призвести к ошибке переводчика</p>
        <p style="color: red; font-size: 30px;">Также возможно относительно долгое ожидание результата</p>


        <div class="mt-5">

            @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif


            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="mt-3">
            @if(auth()->check())

                <h4>Здраствуйте, {{auth()->user()->name}}, рад тебя видеть!</h4>

                <a href="{{route('logout')}}">
                    <button class="btn btn-danger">Выйти с аккаунта</button>
                </a>

            @else
                <a href="{{route('register.create')}}">
                    <button class="btn btn-danger">Регистрация</button>
                </a>
                <a href="{{route('login.create')}}">
                    <button class="btn btn-danger">Авторизация</button>
                </a>

            @endif

        </div>
        <h1 class="my-3">Создать модуль</h1>
        <form action="{{ route('posts.createModule') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="text" class="form-label">Текст</label>
                <input type="text" class="form-control" id="text" name="text">
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
        <h1 class="my-3">Генерация переводов массива слов</h1>
        <form action="{{ route('posts.storePlain') }}" method="post" enctype="multipart/form-data">
            @csrf


            <div class="mb-3">
                <label for="text" class="form-label">Текст</label>
                <input type="text" class="form-control" id="text" name="text">
            </div>

            <div class="mb-3">
                <label for="select" class="form-label">Выберите в какой модуль сохранить</label>
                <select class="form-select" id="selectModule" name="selectModule">
                    @foreach ($answer as $item)
                        <option value="{{$item[0]}}">{{$item[1]}}</option>
                    @endforeach

                </select>
                <label for="select" class="form-label">Выберите вариант</label>
                <select class="form-select" id="select" name="select">
                    <option value="1">С примером использования</option>
                    <option value="2">Без примера использования</option>
                </select>
                <label for="select2" class="form-label">Выберите вариант</label>
                <select class="form-select" id="select2" name="select2">
                    <option value="russian">Русский</option>
                    <option value="ukrainian">Украинский</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
        <h1 class="my-3">Генерация переводов массива слов с картинки</h1>
        <form action="{{ route('posts.storePicture') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="file" class="form-label">Загрузить файл</label>
                <input type="file" class="form-control" id="file" name="file">
            </div>
            <div class="mb-3">
                <label for="select" class="form-label">Выберите в какой модуль сохранить</label>
                <select class="form-select" id="selectModule" name="selectModule">
                    @foreach ($answer as $item)
                        <option value="{{$item[0]}}">{{$item[1]}}</option>
                    @endforeach

                </select>
                <label for="select" class="form-label">Выберите вариант</label>
                <select class="form-select" id="select" name="select">
                    <option value="1">С примером использования</option>
                    <option value="2">Без примера использования</option>
                </select>
                <label for="select2" class="form-label">Выберите вариант</label>
                <select class="form-select" id="select2" name="select2">
                    <option value="russian">Русский</option>
                    <option value="ukrainian">Украинский</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
        <h1 class="my-3">Сканер</h1>
        <h3> После сканирования изображение вы можете отредактивровать текст и его перевести</h3>
        <form action="{{ route('posts.scan') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="file" class="form-label">Загрузить файл</label>
                <input type="file" class="form-control" id="file" name="file">
            </div>

            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>

        <h1 class="my-3">Выберите какой модуль показать</h1>
        <form action="{{ route('posts.show') }}" method="post" enctype="multipart/form-data">
            @csrf

            <select class="form-select" id="selectModule" name="selectModule">
                @foreach ($answer as $item)
                    <option value="{{$item[0]}}">{{$item[1]}}</option>
                @endforeach

            </select>
            <button type="submit" class="btn btn-primary mt-3">Показать</button>
        </form>
        <h1 class="my-3">Выберите какой модуль учить</h1>
        <form action="{{ route('posts.cards') }}" method="post" enctype="multipart/form-data">
            @csrf

            <select class="form-select" id="selectModule" name="selectModule">
                @foreach ($answer as $item)
                    <option value="{{$item[0]}}">{{$item[1]}}</option>
                @endforeach

            </select>
            <button type="submit" class="btn btn-primary mt-3">Показать</button>
        </form>
        @if(Auth::check() and Auth::id() == 1 )
            <div class="mt-3">
                <a href="{{route('posts.clear')}}">
                    <button class="btn btn-danger">очистить все слова</button>
                </a>
            </div>
        @endif
    @endauth
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
{{--<script src='/js/scripts.js'></script>--}}


</body>
</html>
