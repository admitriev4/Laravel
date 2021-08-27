<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('main', ['title' => 'Главная']);
});
Route::get('/registration/', function () {
    return view('registration', ['title' => 'Регистрация']);
});

Route::get('/users/', [UserController::class, 'index']);
Route::post('/users/add/', [UserController::class, 'userAdd']);

