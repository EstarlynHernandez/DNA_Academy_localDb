<?php

use App\Http\Controllers\ArtistiController;
use App\Http\Controllers\ClientiController;
use App\Http\Controllers\ProdottiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FornitoriController;
use App\Http\Controllers\OrdiniController;
use App\Http\Controllers\VeicoliController;
use App\Http\Controllers\ParcheggiController;
use App\Http\Controllers\QuadriController;

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

Route::get('/', function () {
    return view('index');
});

Route::resource('prodotti', ProdottiController::class);
Route::get('groupRemove/prodotti', [ProdottiController::class, 'destroyVoid'])->name('prodotti.groupRemove');

Route::resource('fornitori', FornitoriController::class);

Route::resource('clienti', ClientiController::class);

Route::resource('ordini', OrdiniController::class);
Route::get('groupRemove/ordini', [OrdiniController::class, 'destroyVoid'])->name('ordini.groupRemove');

Route::resource('artisti', ArtistiController::class);
Route::resource('veicoli', VeicoliController::class);
Route::resource('parcheggi', ParcheggiController::class);
Route::resource('quadri', QuadriController::class);
