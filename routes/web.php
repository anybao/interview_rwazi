<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('note');
//});

Route::get('', [NoteController::class, 'index'])->name('index');
Route::post('/', [NoteController::class, 'store'])->name('create');
Route::get('/search', [NoteController::class, 'search'])->name('search');
Route::delete('/{note}', [NoteController::class, 'destroy'])->name('remove');
