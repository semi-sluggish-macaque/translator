<?php

function Maxim($data, $die = false)
{

    echo '<pre>' . print_r($data, 1) . '</pre>';
    if ($die) {
        die;
    }

}
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Translation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">

    <p style="color: #d30a0a; font-size: 80px; text-align: center;">Произошла ошибка!!!</p>
    <p style="color: red; font-size: 50px;text-align: center;">Текст показан в "сыром виде"</p>
    <p style="color: red; font-size: 30px;text-align: center;">Измените вводимые данные либо попробуйте еще раз</p>

    @php   echo '<pre>' . print_r($data, 1) . '</pre>'; @endphp

    <div class="mt-4">
        <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>

