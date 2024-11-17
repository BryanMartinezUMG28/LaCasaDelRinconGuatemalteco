<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
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

Route::get('/welcome', [App\Http\Controllers\PageController::class, 'welcome']);

Route::get('/productos', [App\Http\Controllers\PageController::class, 'productos']);

Route::get('/Inicio', [App\Http\Controllers\PageController::class, 'Inicio']);

Route::get('/despacho', [App\Http\Controllers\PageController::class, 'despacho']);

Route::get('/catalogos', [App\Http\Controllers\PageController::class, 'catalogos']);

Route::get('/gestiones', [App\Http\Controllers\PageController::class, 'gestiones']);

Route::get('/catalogosClientes', [App\Http\Controllers\PageController::class, 'catalogosClientes']);

//Navbar

Route::get('/welcome', [PageController::class, 'welcome'])->name('welcome');

Route::get('/productos', [PageController::class, 'productos'])->name('productos');

Route::get('/Inicio', [PageController::class, 'Inicio'])->name('Inicio');

Route::get('/despacho', [PageController::class, 'despacho'])->name('despacho');

Route::get('/catalogos', [PageController::class, 'catalogos'])->name('catalogos');

Route::get('/gestiones', [PageController::class, 'gestiones'])->name('gestiones');

//BOTONES


Route::get('/catalogosClientes', [PageController::class, 'catalogosClientes'])->name('catalogosClientes');

