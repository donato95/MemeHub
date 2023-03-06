<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
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

Route::middleware('auth')->group(function() {
    Route::get('/', function() {
        return view('main.index');
    })->name('home');
});

Route::controller(UserController::class)->middleware('guest')->group(function() {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'auth')->name('user-auth');
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'store')->name('store-user');
});

Route::controller(PostController::class)->group(function() {
    Route::get('/posts/{post}', 'post')->name('post');
});