<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

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
})->name('main');
Route::get('/registration/', function () {
    return view('registration', ['title' => 'Регистрация']);
});

Route::get('/user/show/update/', function () {
    return view('user.update', ['title' => 'Изменение данных пользователя']);
})->middleware('auth');
Route::get('/user/show/update_pass/', function () {
    return view('user.update_pass', ['title' => 'Изменение пароля пользователя']);
})->middleware('auth');
Route::get('/user/show/delete/', function () {
    return view('user.delete', ['title' => 'Удаление пользователя']);
})->middleware('auth');
Route::get('/user/only-old/', function () {
    return view('user.onlyOld', ['title' => 'Страница для взрослых']);
})->middleware('checkAgeGroup');

Route::get('/logout/', [LoginController::class, 'logout'])->middleware('auth');
Route::match(array('GET','POST'),'/users/', [UserController::class, 'index'])->name('users');
Route::post('/user/add/', [UserController::class, 'userAdd']);
Route::post('/user/update/', [UserController::class, 'userUpdate'])->middleware('auth');
Route::post('/user/update_pass/', [UserController::class, 'userUpdatePass'])->middleware('auth');
Route::get('/user/delete/', [UserController::class, 'userDelete'])->middleware('auth');


