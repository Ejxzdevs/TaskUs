<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AsssignController;

Route::get('/', function () {return view('login'); })->name('login');
Route::get('/register', function () { return view('register'); })->name('register');
Route::post('/login', [UserController::class, 'authenticate'])->name('loginAccount');
Route::resource('users', UserController::class)->only('store');

Route::middleware('auth')->group(function () {

    Route::get('/home', function () { return view('pages.home'); })->name('home');
    Route::resource('tasks', TaskController::class);


    Route::get('/logout', function () {
    Auth::logout();
    Session::flush();
        return redirect()->route('login'); 
    })->name('logout');

    Route::middleware('role:admin')->group(function () { 
        Route::resource('users', UserController::class)->except('store');
        Route::get('/review', function () {return view('pages.review'); })->name('review');
        Route::get('/history', function () {return view('pages.history'); })->name('history');
        Route::get('/member', function () {return view('pages.member'); })->name('member');
        Route::resource('assign', AsssignController::class);
    });
});






