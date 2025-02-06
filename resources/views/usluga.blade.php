@extends('mainsh')

@section('startma')
<div class="container mt-5">
    <h1 class="mb-4">Список услуг</h1>
    
    @if($userRole === 'admin' || $userRole === 'writer')
    <div class="mb-4">
        <h2>Добавить новую услугу</h2>
        <form action="{{ route('usluga.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="new-name">Имя:</label>
                <input type="text" class="form-control" id="new-name" name="name" required>
            </div>
            <div class="form-group">
                <label for="new-category">Категория:</label>
                <select class="form-control" id="new-category" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="new-price">Цена:</label>
                <input type="number" class="form-control" id="new-price" name="price" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Добавить услугу</button>
        </form>
    </div>
    @endif
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Имя</th>
                <th>Категория</th>
                <th>Цена</th>
                @if($userRole === 'admin' || $userRole === 'writer')
                    <th>Действия</th>
                @else
                    <th>Оформить услугу</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($uslugi as $usluga)
                <tr>
                    <td>
                        @if($userRole === 'admin' || $userRole === 'writer')
                            <form action="{{ route('usluga.update', $usluga->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="text" class="form-control" value="{{ $usluga->name }}" name="name" required>
                        @else
                            {{ $usluga->name }}
                        @endif
                    </td>
                    <td>
                        @if($userRole === 'admin' || $userRole === 'writer')
                            <select class="form-control" name="category_id" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        @else
                            {{ $usluga->category }}
                        @endif
                    </td>
                    <td>
                        @if($userRole === 'admin' || $userRole === 'writer')
                            <input type="number" class="form-control" value="{{ $usluga->price }}" name="price" required>
                        @else
                            {{ $usluga->price }} руб.
                        @endif
                    </td>
                    @if($userRole === 'reader')
                        <td>
                            
                                
                                <button type="submit" class="btn btn-primary">Заказать</button>
                            
                        </td>
                    @elseif($userRole === 'admin' || $userRole === 'writer')
                        <td>
                            <button type="submit" class="btn btn-success">Обновить</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection