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
    ->name('user.index');

Route::get('/users/{user}', 'UserController@show')
    ->where('user', '\d+')
    ->name('user.show');

Route::get('/users/create', 'UserController@create')
    ->name('user.create');

Route::post('/users', 'UserController@store')
    ->name('user.store');

Route::get('/users/{user}/edit', 'UserController@edit')
    ->name('user.edit');

Route::put('/users/{user}', 'UserController@update')
    ->name('user.update');

//Route::get('/users/{name}', 'WelcomeUserController@name');

//Route::get('/users/{name}/{nickname}', 'WelcomeUserController@nickname');
