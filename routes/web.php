<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



//

/*
Route::get('/', function () {
    // Проверяем, аутентифицирован ли пользователь
    if (Auth::check()) {
        return redirect()->route('admin'); // Перенаправляем на страницу админа
    } else {
        return redirect()->route('login'); // Перенаправляем на страницу логина
    }
})->name('home');
*/



//



Route::get('/', function () {
    return view('main');
})->name('mainsh');

Route::get('/search', function (Request $request) {
    $query = $request->input('search');

    // Получаем результаты из таблицы vet_uluga
    $results = DB::table('vet_uslugas')
        ->where('name', 'LIKE', "%{$query}%")
        ->orWhere('category', 'LIKE', "%{$query}%")
        ->orWhere('price', 'LIKE', "%{$query}%")
        ->get();

    return view('search_results', compact('results'));
})->name('search');

Route::group(['middleware' => ['role:writer|reader|admin']], function(){

    Route::get('/usluga', function () {
        $uslugi = DB::table('vet_uslugas')->get();
        $categories = DB::table('categories')->select('id', 'name')->get(); 
        if (Auth::check()) {
            $userRoles = Auth::user()->getRoleNames(); // Это возвращает коллекцию ролей
            $userRole = $userRoles->isNotEmpty() ? $userRoles->first() : null; // Получаем первую роль
        } else {
            $userRole = null;
        }
        return view('usluga', compact('uslugi', 'categories', 'userRole'));
    })->name('usluga');

    // Добавление новой услуги
    Route::post('/usluga/store', function (Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        DB::table('vet_uslugas')->insert([
            'name' => $request->name,
            'category' => $request->category_id,
            'price' => $request->price,
        ]);

        return redirect()->route('usluga')->with('success', 'Услуга успешно добавлена!');
    })->name('usluga.store');

    // Обновление услуги
    Route::put('/usluga/update/{id}', function (Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        DB::table('vet_uslugas')->where('id', $id)->update([
            'name' => $request->name,
            'category' => $request->category_id,
            'price' => $request->price,
        ]);

        return redirect()->route('usluga')->with('success', 'Услуга успешно обновлена!');
    })->name('usluga.update');


});

Auth::routes();

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group(['middleware' => ['role:writer|admin']], function(){
    Route::get('/admin',function(){
        return view('admin');
    });
    //moe
//Vetrecords
Route::get('/records', function () {
    $records = DB::table('vetrecord')->get(); // Получаем все записи из VetRecord
    $categories = DB::table('categories')->get(); // Получаем все категории
    return view('records', compact('records', 'categories'));
})->middleware('role:reader|writer|admin');

// Добавление новой записи
Route::post('/records', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'date' => 'required|string', // Ваша дата хранится как строка (можно использовать 'date' если формат даты)
        'price' => 'required|numeric',
        'category' => 'required|string|max:255', // Теперь используется поле category
    ]);

    DB::table('vetrecord')->insert([
        'name' => $validated['name'],
        'date' => $validated['date'],
        'price' => $validated['price'],
        'category' => $validated['category'], // Сохраняем категорию
    ]);

    return redirect('/records')->with('success', 'Запись успешно добавлена!'); // Сообщение об успехе
})->middleware('role:writer|admin');

// Удаление записи
Route::delete('/records/{id}', function ($id) {
    DB::table('vetrecord')->where('id', $id)->delete();
    return redirect('/records')->with('success', 'Запись успешно удалена!'); // Сообщение об успехе
})->middleware('role:writer|admin');


Route::post('/records/update', function (Request $request) {
    $validatedRecords = $request->validate([
        'records.*.name' => 'required|string|max:255',
        'records.*.date' => 'required|string',
        'records.*.price' => 'required|numeric',
        'records.*.category' => 'required|string|max:255',
    ]);

    foreach ($validatedRecords['records'] as $id => $recordData) {
        // Проверьте, что переданный ID является числом
        if (is_numeric($id)) {
            DB::table('vetrecord')->where('id', $id)->update($recordData);
        }
    }


    return redirect('/records')->with('success', 'Записи обновлены успешно!');
})->middleware('role:writer|admin');

Route::get('/records/search', function (Request $request) {
    $query = $request->input('query');
    
    $records = DB::table('vetrecord')
        ->where('name', 'LIKE', "%{$query}%")
        ->orWhere('category', 'LIKE', "%{$query}%")
        ->get();

    $categories = DB::table('categories')->get();

    return view('records', compact('records', 'categories'));
})->name('records.search');

//categooryes
Route::get('/categories', function () {
    $categories = DB::table('categories')->get();
    return view('category', compact('categories'));
})->middleware('role:reader|writer|admin');;

// Добавление новой категории
Route::post('/categories', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
    ]);

    DB::table('categories')->insert([
        'name' => $validated['name'],
    ]);

    return redirect('/categories');
})->middleware('role:writer|admin');

// Удаление категории
Route::delete('/categories/{id}', function ($id) {
    DB::table('categories')->where('id', $id)->delete();
    return redirect('/categories');
})->middleware('role:writer|admin');



//statistic

Route::get('/statistic', function () {
    $type = request('type', 'category');

    switch ($type) {
        case 'category':
            $records = DB::table('vetrecord')
                ->select('category', DB::raw('count(*) as total'))
                ->groupBy('category')
                ->get();
            break;

        case 'date':
            $records = DB::table('vetrecord')
                ->select(DB::raw('DATE_FORMAT(date, "%Y-%m") as month'), DB::raw('count(*) as total'))
                ->groupBy('month')
                ->get();
            break;

        case 'revenue':
            $records = DB::table('vetrecord')
                ->select(DB::raw('DATE_FORMAT(date, "%Y-%m") as month'), DB::raw('sum(price) as total'))
                ->groupBy('month')
                ->get();
            break;

        default:
            abort(404);
    }

    $labels = $type === 'date' ? $records->pluck('month') : $records->pluck('category');
    $data = $records->pluck('total');

    return view('statistic', compact('labels', 'data', 'type'));
});
});




