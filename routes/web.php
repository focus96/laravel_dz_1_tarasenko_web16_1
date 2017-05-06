<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/news/store', 'NewsController@store');
Route::post('/news/index', 'NewsController@index');
Route::get('/news/destroy/{id}', 'NewsController@destroy');
Route::get('/news/edit/{id}', 'NewsController@edit');
Route::post('/news/update', 'NewsController@update');
Route::middleware('auth')->resource('news','NewsController');
