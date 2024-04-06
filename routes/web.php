<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ConsultaController;

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
    return view('welcome');
});

/*
Route::get('/dashboard', [ConsultaController::class, 'index'])
->middleware(['auth', 'verified'])->name('dashboard');
*/

Route::get('/dashboard', [ConsultaController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
    ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
    ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
    ->name('profile.destroy');

    Route::get('/chirps', [ChirpController::class, 'index'])
    ->name('chirps.index');

    Route::post('/chirps', [ChirpController::class, 'store'])
    ->name('chirps.store');

    Route::get('/chirps/edit/{chirp}', [ChirpController::class, 'edit'])
    ->name('chirps.edit');

    Route::put('/chirps/{chirp}', [ChirpController::class, 'update'])
    ->name('chirps.update');

    Route::delete('/chirps/{chirp}', [ChirpController::class, 'destroy'])
    ->name('chirps.destroy');

    Route::get('/querys', [ConsultaController::class, 'index'])
    ->name('querys.index');

    Route::post('/querys', [ConsultaController::class, 'store'])
    ->name('querys.store');

    Route::get('/exportar', [ConsultaController::class, 'exporta'])
    ->name('querys.exporta');
   
    Route::get('phpmyinfo', function () {
        phpinfo(); 
    })->name('phpmyinfo');

});

require __DIR__.'/auth.php';
