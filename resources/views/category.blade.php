@extends('admin')
@section('start')
<body>
    <div class="container mt-5">
        <h2>Управление категориями</h2>
    
        <!-- Форма для добавления новой категории -->
        <form action="/categories" method="POST" class="mb-4">
            @csrf
            <div class="form-group">
                <label for="name">Название категории:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary">Добавить категорию</button>
        </form>
    
        <!-- Список существующих категорий -->
        <h3>Существующие категории</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            
                            <form action="/categories/{{ $category->id }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
@endsection