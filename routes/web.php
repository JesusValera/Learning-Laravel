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


Route::get('/users', function () {
    return '<body>Hello users!</body>';
});

Route::get('users/new', function () {
    return 'Creating new user.';
});

Route::get('/users/{id}', function ($id) {
    return "Showing details of user with id $id";
})->where('id', '\d+');

Route::get('/users/{name}/{nickname?}', function ($name, $nickname = null) {
    if (!isset($nickname))
        return "Hello $name without nickname.";

    return "Hello $name whose nickname is $nickname";
});

