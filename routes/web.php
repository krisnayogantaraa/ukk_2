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
    Route::get('/admin', [AdminController::class, 'index']);
});

// untuk kasir
Route::group(['middleware' => ['auth', 'checkrole:2']], function() {
    Route::get('/kasir', [KasirController::class, 'index']);

});

// untuk meja
Route::group(['middleware' => ['auth', 'checkrole:3']], function() {
    Route::get('/meja', [MejaController::class, 'index']);

});

// untuk manajer
Route::group(['middleware' => ['auth', 'checkrole:4']], function() {
    Route::get('/manajer', [ManajerController::class, 'index']);

});