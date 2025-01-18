<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/w', function () {
    return view('login');
});

Route::get('/', function () {
    return view('pages.home');
});
Route::get('/home', function () {
    return view('pages.home');
})->name('home');

Route::resource('tasks', TaskController::class);
// Route::get('/tasks', [TaskController::class, 'index']);