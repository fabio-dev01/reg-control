<?php

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
use App\Http\Controllers\EncargosController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/logout', function () {
    return view('home');
});

Route::get('/encargos', [EncargosController::class, 'index'])->middleware('auth');
Route::post('/encargos/novo', [EncargosController::class, 'novo'])->middleware('auth');
Route::get('/encargo/ver/{id}', [EncargosController::class, 'ver'])->middleware('auth');
Route::put('/encargo/editar/{id}', [EncargosController::class, 'editar'])->middleware('auth');
Route::delete('/encargo/{id}', [EncargosController::class, 'apagar'])->middleware('auth');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');
