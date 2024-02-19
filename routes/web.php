<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeControll;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\KategoriController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');
// Route::controller(KaryawanController::class)->prefix('karyawan')->group(function () {
//     Route::get('', 'index')->name('karyawan');
// });
Route::resource('karyawan', KaryawanController::class);
Route::resource('kategori', KategoriController::class);
// Route::controller(KategoriController::class)->prefix('kategori')->group(function () {
//     Route::get('', 'index')->name('kategori');
// });

// Route::get('/kategori', 'KategoriController@index')->name('kategori');
// routes/web.php
// Route::get('/karyawan', 'KaryawanController@index')->name('karyawan');
// Route::get(KaryawanController::class);
// Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan');
Route::controller(PemesananController::class)->prefix('pemesanan')->group(function () {
    Route::get('', 'index')->name('pemesanan');
});
// Route::controller(KaryawanController::class)->prefix('karyawan')->group(function () {
//     Route::get('', 'index')->name('karyawan');
// });