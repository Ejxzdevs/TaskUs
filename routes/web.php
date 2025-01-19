<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AsssignController;

Route::get('/home', function () { return view('pages.home'); })->name('home');
Route::get('/register', function () { return view('register'); })->name('register');

Route::get('/', function () {return view('login'); })->name('login');
Route::post('/login', [UserController::class, 'authenticate'])->name('loginAccount');
Route::resource('users', UserController::class);
Route::resource('tasks', TaskController::class);
Route::resource('assign', AsssignController::class);
Route::get('/logout', function () {
    Auth::logout();
    Session::flush();
    return redirect()->route('login'); 
})->name('logout');