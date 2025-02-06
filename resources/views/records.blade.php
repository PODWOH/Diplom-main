@extends('admin')
@section('start')
<body>
<div class="container mt-5">
    <h1>Администрирование Записей</h1>

    <form class="table table-striped" action="/records"  class="form-control" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Название записи:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="date">Дата:</label>
            <input type="date" id="date" name="date"  class="form-control" required>
        </div>
        <div class="form-group">
            <label for="price">Цена:</label>
            <input type="number" id="price" name="price" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="category">Категория:</label>
            <select id="category" name="category" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Добавить запись</button>
    </form>

    <h2>Существующие Записи</h2>


    <form action="{{ route('records.search') }}" method="GET" class="form-inline mb-3">
        <input type="text" name="query" class="form-control mr-2" placeholder="Поиск по имени" >
        <button type="submit" class="btn btn-info">Поиск</button>
    </form>


    <form action="/records/update" method="POST">
        @csrf
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Дата</th>
                    <th>Цена</th>
                    <th>Категория</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                    <tr>
                        <td>{{ $record->id }}</td>
                        <td>
                            <input type="text" name="records[{{ $record->id }}][name]" value="{{ $record->name }}" class="form-control" required>
                        </td>
                        <td>
                            <input type="date" name="records[{{ $record->id }}][date]" value="{{ $record->date }}" class="form-control" required>
                        </td>
                        <td>
                            <input type="number" name="records[{{ $record->id }}][price]" value="{{ $record->price }}" class="form-control" required>
                        </td>
                        <td>
                            <select name="records[{{ $record->id }}][category]" class="form-control" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->name }}" {{ $category->name == $record->category ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-danger btn-sm " onclick="deleterecord({{ $record->id }})">Удалить</button>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-success">Сохранить изменения</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</div>
<script>
    function deleterecord(recordID) {
        if (confirm('Вы уверены, что хотите удалить этот продукт?')) {
            fetch(`/records/${recordID}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (response.ok) {
                    window.location.reload();
                } else {
                    console.error('Ошибка удаления продукта');
                }
            })
            .catch(error => {
                console.error('Произошла ошибка:', error);
            });
        }
    }
</script>
</body>
@endsection