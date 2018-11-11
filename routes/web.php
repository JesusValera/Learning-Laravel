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

Route::get('/', 'UserController@index')
    ->name('users.index');

Route::get('/users/{user}', 'UserController@show')
    ->where('user', '\d+')
    ->name('users.show');

Route::get('/users/create', 'UserController@create')
    ->name('users.create');

Route::post('/users', 'UserController@store')
    ->name('users.store');

Route::get('/users/{user}/edit', 'UserController@edit')
    ->name('users.edit');

Route::put('/users/{user}', 'UserController@update')
    ->name('users.update');

Route::delete('/users/{user}', 'UserController@destroy')
    ->name('users.destroy');

//Route::get('/users/{name}', 'WelcomeUserController@name');

//Route::get('/users/{name}/{nickname}', 'WelcomeUserController@nickname');
