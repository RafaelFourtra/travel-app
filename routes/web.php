<?php

use App\Http\Controllers\AgenController;
use App\Http\Controllers\DataVaksinController;
use App\Http\Controllers\JamaahController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
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

Route::get('/', function () {
    return redirect()->to('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('jamaah', JamaahController::class);
    Route::get('getJamaah', [JamaahController::class, 'get'])->name('jamaah.get');

    Route::resource('agen', AgenController::class);
    Route::get('getAgen', [AgenController::class, 'get'])->name('agen.get');

    Route::resource('paket', PaketController::class);
    Route::get('getPaket', [PaketController::class, 'get'])->name('paket.get');
    Route::post('update-paket/{id}', [PaketController::class, 'UpdatePaket'])->name('paket.update');

    Route::resource('vaksin', DataVaksinController::class);
    Route::get('getVaksin', [DataVaksinController::class, 'get'])->name('vaksin.get');
    Route::post('update-vaksin/{id}', [DataVaksinController::class, 'UpdateVaksin'])->name('vaksin.update');

    Route::resource('transaksi', TransaksiController::class);
    Route::post('transaksi-pelunasan', [TransaksiController::class, 'pelunasan'])->name('transaksi.pelunasan');
    Route::get('getTransaksi', [TransaksiController::class, 'get'])->name('transaksi.get');

});

require __DIR__ . '/auth.php';
