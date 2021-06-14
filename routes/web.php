<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

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

Route::get('/note', [NoteController::class, 'getAllNotes'])->name('note');

Route::post('/note', [NoteController::class, 'addNote']);

Route::get('/note/{id}', [NoteController::class, 'getNote']);

Route::put('/note/{id}', [NoteController::class, 'updateNote']);

Route::delete('/note/{id}', [NoteController::class, 'delNote']);