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
Route::get('/user/show/update/', function () {
    return view('user.update', ['title' => 'Изменение данных пользователя']);
});
Route::get('/user/show/update_pass/', function () {
    return view('user.update_pass', ['title' => 'Изменение пароля пользователя']);
});
Route::get('/user/show/delete/', function () {
    return view('user.delete', ['title' => 'Удаление пользователя']);
});


Route::post('/users/', [UserController::class, 'index']);
Route::post('/user/add/', [UserController::class, 'userAdd']);
Route::post('/user/update/', [UserController::class, 'userUpdate']);
Route::post('/user/update_pass/', [UserController::class, 'userUpdatePass']);
Route::post('/user/delete/', [UserController::class, 'userDelete']);


