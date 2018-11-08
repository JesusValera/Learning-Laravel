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

Route::get('/users', 'UserController@index')
    ->name('user_index');

Route::get('users/new', 'UserController@create');

Route::get('/users/{user}', 'UserController@show')
    ->name('user_show')
    ->where('user', '\d+');

Route::get('/users/{id}/edit', 'UserController@edit')
    ->where('id', '\d+');

Route::get('/users/{name}', 'WelcomeUserController@name');

Route::get('/users/{name}/{nickname}', 'WelcomeUserController@nickname');

