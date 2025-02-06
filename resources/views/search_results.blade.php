<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Результаты поиска</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1>Результаты поиска:</h1>
    
    @if($results->isEmpty())
        <p>Ничего не найдено.</p>
    @else
        <ul class="list-group">
            @foreach($results as $item)
                <li class="list-group-item">
                    <strong>{{ $item->name }}</strong><br>
                    Категория: {{ $item->category }}<br>
                    Цена: {{ $item->price }}
                </li>
            @endforeach
        </ul>
    @endif

    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Назад к поиску</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>