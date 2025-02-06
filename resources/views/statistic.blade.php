@extends('admin')

@section('start')
<body>
    <h1 style="text-align: center;">Статистика</h1>

    <div class="button-group" style="text-align: center; margin-bottom: 20px;">
        <a href="{{ url('/statistic?type=category') }}" class="btn btn-success">По категориям</a>
        <a href="{{ url('/statistic?type=date') }}" class="btn btn-success">По месяцам</a>
        <a href="{{ url('/statistic?type=revenue') }}" class="btn btn-success">По выручке</a>
    </div>

    <div style="width: 60%; margin: auto;">
        <h2 style="text-align: center;">Круговая диаграмма</h2>
        <canvas id="pieChart"></canvas>
    </div>

    <div style="width: 60%; margin: auto; margin-top: 40px;">
        <h2 style="text-align: center;">Лестничная диаграмма</h2>
        <canvas id="barChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Данные для круговой диаграммы
        const pieData = {
            labels: {!! json_encode($labels) !!}, 
            datasets: [{
                label: 'Количество',
                data: {!! json_encode($data) !!},  // Используем $data
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        };

        const pieConfig = {
            type: 'pie',
            data: pieData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Распределение по категориям'
                    }
                }
            },
        };

        new Chart(document.getElementById('pieChart'), pieConfig);

        // Данные для лестничной диаграммы
        const barData = {
            labels: {!! json_encode($labels) !!},  
            datasets: [{
                label: 'Количество записей',
                data: {!! json_encode($data) !!},  // Используем $data
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        const barConfig = {
            type: 'bar',
            data: barData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Количество записей по категориям/месяцам'
                    }
                }
            },
        };

        new Chart(document.getElementById('barChart'), barConfig);
    </script>
</body>
@endsection