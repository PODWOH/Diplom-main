<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: url('your-panorama-image.jpg') no-repeat center center fixed;
            background-size: cover;
            color: black; /* Изменено на черный */
        }
        .navbar {
            backdrop-filter: blur(5px);
        }
        .navbar .nav-link,
        .navbar .navbar-brand {
            color: black; /* Черный цвет текста */
        }
        .navbar .nav-link:hover, 
        .navbar .navbar-brand:hover {
            color: darkgray; /* Цвет при наведении */
        }
        .photo-container {
        padding-left: 20px; /* Отступ слева */
        padding-right: 20px; /* Отступ справа */
    }
    .img-custom {
        width: 250px; /* Ширина изображения */
        height: 250px; /* Высота изображения */
        object-fit: cover; /* Чтобы сохранять пропорции вне зависимости от размеров */
        margin: 10px; /* Отступ между изображениями */
    }
    </style>
</head>
<body>

<!-- Навигационная панель -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <!-- Кнопка Главная -->
        <a class="navbar-brand" href="{{ route('mainsh') }}">Главная</a>
        
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <!-- Кнопка Услуги -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('usluga') }}">Услуги</a>
                </li>
            </ul>
        </div>
        
        <div class="ml-auto">
            <!-- Поле для поиска -->
            <form action="{{ route('search') }}" method="GET" class="form-inline">
                <input type="text" class="form-control mr-2" name="search" placeholder="Поиск услуги" aria-label="Search">
                <button type="submit" class="btn btn-success">Найти</button>
            </form>

            <!-- Кнопки для пользователя -->
            <div id="user-area" class="ml-3">
                @if(Auth::check())
                    <span>{{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Выход</button>
                    </form>
                @else
                    <a href="{{ route('register') }}" class="btn btn-primary">Регистрация</a>
                    <a href="{{ route('login') }}" class="btn btn-secondary">Вход</a>
                @endif
            </div>
        </div>
    </div>
</nav>
@yield('startma')

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>