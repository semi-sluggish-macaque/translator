<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'auth'], function () {

    Route::get('/show-module', 'ModuleController@show')->name('show.module');
    Route::post('/create-module', 'ModuleController@createModule')->name('create.module');

    Route::get('/show-words/{id}', 'WordsController@show')->name('show.words');
    Route::post('/save-words', 'WordsController@save')->name('save.words');
    Route::get('/learn-words/{id}', 'WordsController@learn')->name('learn.words');

    Route::get('/translate', 'TranslateController@index')->name('array.translation');
    Route::match(['get', 'post'], '/translate-array', 'TranslateController@translate')->name('array.translate');
    Route::post('/save-array', 'TranslateController@save')->name('save.array');

    Route::get('/translate-scan', 'ScanController@index')->name('scan.translation');
    Route::post('/scann', 'ScanController@scan')->name('scan');
    Route::post('/your-image-upload-endpoint', 'ScanController@upload')->name('upload');

    Route::post('/print', 'WordController@download_doc')->name('print');


//    Route::post('/storePlain', 'HomeController@storePlain')->name('posts.storePlain');
//    Route::post('/createPicture', 'HomeController@storePicture')->name('posts.storePicture');
//    Route::post('/scan', 'HomeController@scan')->name('posts.scan');
//    Route::match(['get', 'post'], '/show', 'HomeController@show')->name('posts.show');
//    Route::get('/clear', 'HomeController@clear')->name('posts.clear');
//    Route::post('/createModule', 'HomeController@createModule')->name('posts.createModule');
//    Route::match(['get', 'post'], '/download_doc', 'TranslateController@download_doc')->name('posts.doc');
//    Route::match(['get', 'post'], '/save', 'HomeController@save')->name('posts.save');
//    Route::match(['get', 'post'], '/cards', 'HomeController@cards')->name('posts.cards');
    Route::get('/logout', 'Usercontroller@logout')->name('logout')->middleware('auth');

});
Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', 'Usercontroller@create')->name('register.create');
    Route::post('/register', 'Usercontroller@store')->name('register.store');
    Route::get('/login', 'Usercontroller@loginFrom')->name('login.create');
    Route::post('/login', 'Usercontroller@login')->name('login');

});
//
//добалвение middleware, если чел не авторизованый, он сюда не попадет

Route::fallback(function () {
//    return redirect()->route('home');
    abort(404, 'Oops! Page not found...');
});
