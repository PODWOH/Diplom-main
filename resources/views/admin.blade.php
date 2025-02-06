
<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>Подвал админа</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="/docs/5.3/assets/js/color-modes.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>

.footer {
    margin-top: auto;
}
canvas {
-moz-user-select: none;
-webkit-user-select: none;
-ms-user-select: none;
user-select: none;
}

.bd-placeholder-img {
font-size: 1.125rem;
text-anchor: middle;
-webkit-user-select: none;
-moz-user-select: none;
user-select: none;
}

@media (min-width: 768px) {
.bd-placeholder-img-lg {
  font-size: 3.5rem;
}
}

.b-example-divider {
width: 100%;
height: 3rem;
background-color: rgba(0, 0, 0, .1);
border: solid rgba(0, 0, 0, .15);
border-width: 1px 0;
box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
}

.b-example-vr {
flex-shrink: 0;
width: 1.5rem;
height: 100vh;
}

.bi {
vertical-align: -.125em;
fill: currentColor;
}

.nav-scroller {
position: relative;
z-index: 2;
height: 2.75rem;
overflow-y: hidden;
}

.nav-scroller .nav {
display: flex;
flex-wrap: nowrap;
padding-bottom: 1rem;
margin-top: -1px;
overflow-x: auto;
text-align: center;
white-space: nowrap;
-webkit-overflow-scrolling: touch;
}

.btn-bd-primary {
--bd-violet-bg: #712cf9;
--bd-violet-rgb: 112.520718, 44.062154, 249.437846;

--bs-btn-font-weight: 600;
--bs-btn-color: var(--bs-white);
--bs-btn-bg: var(--bd-violet-bg);
--bs-btn-border-color: var(--bd-violet-bg);
--bs-btn-hover-color: var(--bs-white);
--bs-btn-hover-bg: #6528e0;
--bs-btn-hover-border-color: #6528e0;
--bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
--bs-btn-active-color: var(--bs-btn-hover-color);
--bs-btn-active-bg: #5a23c8;
--bs-btn-active-border-color: #5a23c8;
}

.bd-mode-toggle {
z-index: 1500;
}

.bd-mode-toggle .dropdown-menu .active .bi {
display: block !important;
}

</style>
</head>
<body class="d-flex">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px;">
        <a href="/admin" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-4">Кастомная панель администрирования</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="/records" class="nav-link " aria-current="page">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
            Общие записи
            </a>
        </li>
        <li>
            <a href="/categories" class="nav-link text-white">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
            Категории
            </a>
        </li>
        <li>
            <a href="/statistic" class="nav-link text-white">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
            Статистика
            </a>
        </li>
        <li>
            <a href="/admin" class="nav-link text-white">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
            Скоро будет
            </a>
        </li>
        </ul>
        <hr>
        <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQhxzODHKzHK6MSrP_b5BMMrM5BAlv3ApF8QfJfUt-Dsg&s" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong>{{Auth::user()->name}}</strong>
        </a>
        </div>
        
            <form action="{{route('logout')}}" method="POST" class="mb-0">
                @csrf
                <button  class="btn btn-primary m-2" type="submit">Выйти </button>
            </form>
        
    </div>
    <div class="b-example-divider b-example-vr"></div>
    @yield('start')
</body>
</html>