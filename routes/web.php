<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\ManajerController;

//  jika user belum login
Route::group(['middleware' => 'guest'], function() {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/', [AuthController::class, 'dologin']);

});

// untuk semua role
Route::group(['middleware' => ['auth', 'checkrole:1,2,3,4']], function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/redirect', [RedirectController::class, 'cek']);
});


// untuk admin
Route::group(['middleware' => ['auth', 'checkrole:1']], function() {
    Route::resource('/admin', \App\Http\Controllers\AdminController::class);
    Route::get('/akun', [AdminController::class, 'akun'])->name('akun');
});

// untuk kasir
Route::group(['middleware' => ['auth', 'checkrole:2']], function() {
    Route::resource('/kasir', \App\Http\Controllers\KasirController::class);
    Route::get('/pesan', [KasirController::class, 'pesan'])->name('pesan');
    Route::post('/tambah-keranjang', [KasirController::class, 'tambah_keranjang'])->name('tambah-keranjang');
    Route::post('/hapus-keranjang', [KasirController::class, 'hapus_keranjang'])->name('hapus-keranjang');
    Route::get('/keranjang', [KasirController::class, 'keranjang'])->name('keranjang');
    Route::get('/keranjang_meja/{no_meja}/{id_transaksi}', [KasirController::class, 'keranjang_meja'])->name('keranjang_meja');
    Route::post('/transaksi', [KasirController::class, 'transaksi'])->name('transaksi');
    Route::get('/riwayat', [KasirController::class, 'riwayat'])->name('riwayat');
    Route::post('/meja_bayar{id_transaksi}', [KasirController::class, 'meja_bayar'])->name('meja_bayar');
    Route::get('/cetak_invoice', [KasirController::class, 'cetak_invoice'])->name('cetak_invoice');
});

// untuk meja
Route::group(['middleware' => ['auth', 'checkrole:3']], function() {
    Route::resource('/meja', \App\Http\Controllers\MejaController::class);
    Route::get('/meja_pesan', [MejaController::class, 'meja_pesan'])->name('meja_pesan');
    Route::post('/tambah-keranjang-meja', [MejaController::class, 'tambah_keranjang'])->name('tambah-keranjang-meja');
    Route::post('/hapus-keranjang-meja', [MejaController::class, 'hapus_keranjang'])->name('hapus-keranjang-meja');
    Route::get('/keranjang-meja', [MejaController::class, 'keranjang'])->name('keranjang-meja');
    Route::get('/batalkan_pesanan', [MejaController::class, 'batalkan_pesanan'])->name('batalkan_pesanan');

});

// untuk manajer
Route::group(['middleware' => ['auth', 'checkrole:4']], function() {
    Route::resource('/manajer', \App\Http\Controllers\ManajerController::class);
    Route::get('/menu', [ManajerController::class, 'menu'])->name('menu');
});