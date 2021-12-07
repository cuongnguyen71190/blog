<?php

use Illuminate\Support\Facades\Route;

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
    return redirect(route('home'));
});

Route::middleware('guest')
    ->group(function() {
        Route::get('/login', [App\Http\Controllers\UsersController::class, 'showForm'])->name('getLogin');
        Route::post('/login', [App\Http\Controllers\UsersController::class, 'login'])->name('login');
        Route::get('/register', [App\Http\Controllers\UsersController::class, 'showRegisterForm'])->name('getRegister');
        Route::post('/register', [App\Http\Controllers\UsersController::class, 'register'])->name('register');
    });

Route::middleware('auth')
    ->group(function() {
        Route::get('/home', function() {
            return view('home');
        })->name('home');

        Route::post('/logout', 'App\Http\Controllers\UsersController@logout')->name('logout');
    });

Route::resource('/posts', 'App\Http\Controllers\PostsController');

Route::get('/filter', [App\Http\Controllers\FilterController::class, 'index'])->middleware('admin')->name('filter');
