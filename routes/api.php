<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::post('user/send-active-mail', 'UserController@sendActiveMail');
Route::get('user/activate', 'UserController@activate')->name('user.activate');
Route::get('me', 'UserController@me');

Route::patch('todos/{todo}/success', 'TodoController@success');
Route::patch('todos/{todo}/failed', 'TodoController@failed');

Route::resources([
    'articles' => 'ArticleController',
    'todos' => 'TodoController',
]);
