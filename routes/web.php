<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;

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
})->name('welcome');

Route::prefix('/data-buku')->name('data_buku.')->group(function(){
    Route::get('/data', [BookController::class, 'index'])->name('data');
    Route::get('/tambah', [BookController::class, 'create'])->name('tambah');
    Route::post('/tambah/proses', [BookController::class, 'store'])->name('tambah.proses');
    Route::get('/ubah/{id}', [BookController::class, 'edit'])->name('ubah');
    Route::patch('/ubah/{id}/proses', [BookController::class, 'update'])->name('ubah.proses');
    Route::delete('/hapus/{id}', [BookController::class, 'destroy'])->name('hapus');
    Route::patch('/ubah/stock/{id}', [BookController::class, 'updateStock'])->name('ubah.stock');
});

Route::prefix('/kelola-akses')->name('kelola_akses.')->group(function(){
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/tambah', [UserController::class, 'create'])->name('tambah');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/ubah/{id}', [UserController::class, 'edit'])->name('ubah');
    Route::patch('/ubah/{id}/proses', [UserController::class, 'update'])->name('ubah.proses');
    Route::delete('/hapus/{id}', [UserController::class, 'destroy'])->name('hapus');
});
