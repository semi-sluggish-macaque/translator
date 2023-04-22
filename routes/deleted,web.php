<?php
//Route::get('/', function () {
//    return view('welcome');
//});
//Route::get('/', function () {
//    return 111;
//});
Route::get('/', function () {
    $name = 'Vasya';
//передача переменной
//    метод ниже редко юзается
//    return view('home')->with('name', $name);
//    передача переменных
//    return view('home', ['name' => $name]);
//    перелача переменных
    return view('home', compact('name'));
})->name('home');
Route::get('/about', function () {
    return 'about';
});
//Route::get('/contact', function () {
//    return view('contact');
//});
//Route::post('/send-email', function () {
//    if(!empty($_POST)){
//        dump($_POST);
//    }
//    return 'Send Email';
//});

//можно заюсзать  "Route::any();" поддерживает все типы запросов
//Route::match(['post', 'get'], '/contact', function () {
//    if (!empty($_POST)) {
//        dump($_POST);
//    }
//    return view('contact');
//
//});

Route::match(['post', 'get', 'put'], '/contact2', function () {
    if (!empty($_POST)) {
        dump($_POST);
    }
    return view('contact');
//именованый маршрут
})->name('contact');

//примитивный роутинг
//Route::view('/test', 'test', ['test' =>'Test data']);

//редирект с передачаё нужного кода
//Route::redirect('/about', '/contact', 301);
//аналог прошлой записи(код 301 = страница устарели и всегда с неё будет переадресация на другую. поисковый робот исключит её с ранжирования)
//Route::permanentRedirect('/about', '/contact');

// id - параметр - может быть любым
//вернет Post и id с строки
// в id разрешены сдедующие символы: [\w_](regexp)(возможно уже изменилось чек доки)
//Route::get('/post/{id}', function ($id){
//    return "Post $id";
//});

//вернет Post id slug
//в where указывается допустимые значения того или иного элемента
//Route::get('/post/{id}/{slug}', function ($id, $slug) {
//    return "Post $id $slug";
//})        ->where(['id' => '[0-9]+', 'slug' => '[A-Za-z0-9-]+']);

//тут глобально устновлены допустимые значия выше

//
//Route::get('/post/{id}/{slug}', function ($id, $slug) {
//    return "Post $id, $slug";
//});

//вопроситенльный знак после slug делает данное поле необязательным
//Route::get('/post/{id}/{slug?}', function ($id, $slug = null ) {
//    return "Post $id, $slug";
//});

//группировка путей и добавление префикса "admin" для каждого
//теперь имя каждого маршрута будет начинатся с admin.
Route::prefix('admin')->name('admin.')->group(function () {
////(http://laravel.loc/admin/posts)
    Route::get('/posts', function () {
        return 'Posts List';
    });

    Route::get('/post/create', function () {
        return 'Posts create';
    });
    Route::get('/post/{id}/edit', function ($id) {
        return "Edit post $id";
//        admin.post
    })->name('post');
});

//при запросе несуществующих страниц будет переадресация на страницу с путём под названием home
//Route::fallback(function (){
//    return redirect()->route('home');
//});

Route::fallback(function () {
    abort(404, 'о боже, такой страницы нет...');
});

