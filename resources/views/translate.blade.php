<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Translation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .add-row-btn {
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Translation Results</h1>
    <form id="dataForm" method="POST">
        @csrf

        <input type="hidden" name="my-hidden-input" value="my-hidden-value">

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
                    <td><input class="form-control" type="text" name="data[{{ $index }}][0]"
                               value="{{ $item[0] }}"></td>
                    <td><input class="form-control" type="text" name="data[{{ $index }}][1]"
                               value="{{ $item[1] }}"></td>
                    <td>
                        <button class="btn btn-danger delete-row-btn" type="button">Удалить</button>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3">
                    <button class="btn btn-primary add-row-btn" type="button">Добавить строку</button>
                </td>
            </tr>
            </tbody>
        </table>
        <button class="btn btn-primary mb-1" type="button" onclick="submitForm('{{ route('posts.save') }}')">Cохранить
            данные
        </button>
        <button class="btn btn-primary mb-1" type="button" onclick="submitForm('{{ route('posts.doc') }}')">Скачать word
            документ слов
        </button>
    </form>
    <div class="mt-4">
        <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
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

    $(document).ready(function () {
        $('body').on('click', '.add-row-btn', function () {
            const lastElementName = $('.form-control:last').attr('name');
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

            const newRow = $(`<tr><td><input class="form-control" type="text" name="data[${number}][0]"></td><td><input class="form-control" type="text" name="data[${number}][1]"></td> <td><button class="btn btn-danger delete-row-btn" type="button">Удалить</button></td>
</tr>`);

            newRow.insertBefore($(this).closest('tr'));
        });
    });


</script>
</body>
</html>
