<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\NoteController;
use App\Http\Controllers\AuthController;
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
    return view('home');
});

Route::get('/dashboard', [UserController::class, 'getUser'])->middleware(['auth'])->name('dashboard');

Route::get('/logout', [AuthController::class, 'logout'])->middleware(['auth']);

Route::get('/note', [NoteController::class, 'getAllNotes'])->middleware(['auth'])->name('note');

Route::post('/note', [NoteController::class, 'addNote'])->middleware(['auth']);

Route::get('/note/{id}', [NoteController::class, 'getNote'])->middleware(['auth']);

Route::put('/note/{id}', [NoteController::class, 'updateNote'])->middleware(['auth']);

Route::delete('/note/{id}', [NoteController::class, 'delNote'])->middleware(['auth']);

Route::get('/user', [UserController::class, 'getAllUsers'])->middleware(['auth']);

Route::put('/user', [UserController::class, 'updateUser'])->middleware(['auth']);

Route::put('/user/telegram', [UserController::class, 'updateTelegramChatId'])->middleware(['auth']);

Route::put('/password', [UserController::class, 'updatePassword'])->middleware(['auth']);

Route::delete('/user/{id}', [UserController::class, 'delUser'])->middleware(['auth']);

require __DIR__.'/auth.php';
