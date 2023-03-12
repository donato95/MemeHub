<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\App;
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

// Route::get('/', function() {
//     return redirect(app()->getLocale());
// });

// if(!in_array($lang, ['en', 'ar'])) {
//     abort(400);
// }
// App::setLocale($lang);

// Route::get('/{lang}/switch/{langu}', function($lang, $langu) {
//     // public function switch($lang) {
//     app()->setLocale($langu);
//     session()->put('lang', $langu);
//     return redirect()->back(); //route('home', ['lang'=>$langu]);
// })->name('switch');

Route::prefix('/{lang}')->middleware('setLocal')->group(function($lang) {

    Route::get('/switch-to/{language}', function($lang, $language) {
        app()->setLocale($language);
        session()->put('lang', $language);
        return redirect()->back();
    })->name('switch');

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

    Route::get('/logout', [UserController::class, 'logout'])->middleware('auth')->name('logout');

    
    Route::controller(PostController::class)->group(function() {
        Route::get('/posts/{post}', 'post')->name('post');
    });
});
