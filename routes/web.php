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
Route::middleware('auth')->resource('news','NewsController');

Route::post('/news/store', [
    'uses' => 'NewsController@store',
    'middleware' => 'accessRoleModerator',
]);
Route::get('/news/create', [
    'uses' => 'NewsController@create',
    'middleware' => 'accessRoleModerator',
]);

Route::get('/news/destroy/{id}', [
    'uses' => 'NewsController@destroy',
    'middleware' => 'accessRoleAdmin',
]);

Route::get('/news/edit/{id}', [
    'uses' => 'NewsController@edit',
    'middleware' => 'accessRoleModerator',
]);

Route::post('/news/update', [
    'uses' => 'NewsController@update',
    'middleware' => 'accessRoleModerator',
]);