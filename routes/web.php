<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeDashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\RiwayatController;

Route::get('/', [HomeDashboardController::class, 'index'])->name('dashboard.home');

// USERS ROUTE
Route::get('/user/', [UserController::class, 'index'])->name("user.home");
Route::get('/user/create', [UserController::class, 'create'])->name("user.create");
Route::post('/user/create', [UserController::class, 'createPost'])->name("user.createPost");
Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name("user.edit");
Route::put('/user/{user}/edit', [UserController::class, 'editPost'])->name("user.editPost");
Route::delete('/user/{user}/hapus', [UserController::class, 'hapus'])->name("user.hapus");

// ROLE ROUTE
Route::get('/role/', [RoleController::class, 'index'])->name("role.home");
Route::get('/role/create', [RoleController::class, 'create'])->name("role.create");
Route::post('/role/create', [RoleController::class, 'createPost'])->name("role.createPost");

// KENDARAAN ROUTE
Route::get('/kendaraan/', [KendaraanController::class, 'index'])->name("kendaraan.home");
Route::get('/kendaraan/create', [KendaraanController::class, 'create'])->name("kendaraan.create");
Route::post('/Kendaraan/create', [KendaraanController::class, 'createPost'])->name("kendaraan.createPost");

// PESANAN ROUTE
Route::get('/pesanan/', [PemesananController::class, 'index'])->name("pesanan.home");
Route::get('/pesanan/create', [PemesananController::class, 'create'])->name("pesanan.create");
Route::post('/pesanan/create', [PemesananController::class, 'createPost'])->name("pesanan.createPost");

// RIWAYAT ROUTE
Route::get('/riwayat/', [RiwayatController::class, 'index'])->name("riwayat.home");
