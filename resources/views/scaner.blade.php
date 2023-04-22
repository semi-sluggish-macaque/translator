<?php
function Maxim($data, $die = false)
{
    $text = print_r($data, 1);
    if ($die) {
        die;
    }
    return $text;
}

$data = Maxim($answer);
$data_formatted = str_replace(["\r\n", "\n", "\r"], '&#13;&#10;', htmlspecialchars($data));
?>

    <!DOCTYPE html>
<!-- остальная часть кода -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adaptive Input</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .adaptive-input {
            max-width: 1920px;
            height: 500px;
            resize: none;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        @media (max-width: 575px) {
            .adaptive-input {
                width: 100%;
                height: auto;
            }
        }
    </style>
</head>
<body>
<div class="container mt-3">
    <div class="row">
        <h1 style="color: gold; text-align: center;">Результат скана</h1>
        <div class="col-12">
            <form id="dataForm" method="POST">
            @csrf

            <textarea  id="dataInput" class="form-control adaptive-input" name="data">{!! $data_formatted !!}</textarea>
                <button class="btn btn-primary" type="button" onclick="submitForm('{{ route('posts.doc') }}')">Сохранить данные в doc</button>

                <div class="mb-3">
                    <label for="select" class="form-label">Выберите в какой модуль сохранить</label>
                    <select class="form-select" id="selectModule" name="selectModule">
                        @foreach ($modules as $item)
                            <option value="{{$item[0]}}">{{$item[1]}}</option>
                        @endforeach

                    </select>
                    <label for="select" class="form-label">Выберите вариант</label>
                    <select class="form-select" id="select" name="select">
                        <option value="1">С примером использования</option>
                        <option value="2">Без примера использования</option>
                        <option value="3">Перевести как цельный текст</option>
                    </select>
                    <label for="select2" class="form-label">Выберите вариант</label>
                    <select class="form-select" id="select2" name="select2">
                        <option value="russian">Русский</option>
                        <option value="ukrainian">Украинский</option>
                    </select>
                </div>

                <button class="btn btn-primary" type="button" onclick="submitForm('{{ route('posts.storePicture') }}')">Перевести данные</button>
            </form>
        </div>
    </div>
    <div class="mt-4" style="color: gold; ">
        <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script>
    function submitForm(action) {
        const form = document.getElementById('dataForm');
        form.action = action;
        form.submit();
    }
</script>
</body>
</html></body>
</html>
