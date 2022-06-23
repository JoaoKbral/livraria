<?php

use App\Http\Controllers\AutoresController;
use App\Http\Controllers\EditorasController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\MidiaController;
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
    return view('welcome');
});
# Parte livro
Route::resource('livros', LivroController::class);
Route::any('/livros/search',[LivroController::class,'search'])->name('livros.search');

Route::resource('editoras',EditorasController::class);
Route::any('/editoras/search',[EditorasController::class,'search'])->name('editoras.search');

Route::resource('autores',AutoresController::class);
Route::any('/autores/search',[AutoresController::class,'search'])->name('autores.search');

Route::resource('midias', MidiaController::class);

// Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

