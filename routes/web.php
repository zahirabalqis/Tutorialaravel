<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/helloworld', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/task/create', [TaskController::class, 'create'])->name('task.create');
Route::post('/task', [TaskController::class, 'store' ])->name('task.store');

Route::get('/', [TaskController::class , 'index'])->name('task.index');
Route::get('/task/{task}', [TaskController::class, 'show'])->name('task.show');

Route::get('/task/{task}/edit', [TaskController::class, 'edit'])->name('task.edit');
Route::put('/task/{task}', [TaskController::class, 'update'])->name('task.update');
Route::delete('/task/{task}', [TaskController::class, 'destroy'])->name('task.destroy');