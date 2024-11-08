<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController ,HomeDashboardController, UserController, RoleController, KendaraanController, PemesananController, RiwayatController};

Route::middleware(['guest'])->group(function () {
    // AUTH ROUTE
    Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('auth.loginPost');
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('auth.registerPost');
});

Route::middleware(['auth'])->group(function () {
    // AUTH ROUTE
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    
    // DASHBOARD ROUTE
    Route::get('/', [HomeDashboardController::class, 'index'])->name('dashboard.home');
    Route::middleware(['cekRole:sopir,super'])->group(function () {
        Route::get('/booking', [HomeDashboardController::class, 'booking'])->name('dashboard.booking');
        Route::get('/booking/create', [HomeDashboardController::class, 'bookingCreate'])->name('dashboard.bookingCreate');
        Route::post('/booking/create', [HomeDashboardController::class, 'bookingCreatePost'])->name('dashboard.bookingCreatePost');
        Route::delete('/booking/delete', [HomeDashboardController::class, 'bookingDelete'])->name('dashboard.bookingDelete');
    });
    
    Route::middleware(['can:super'])->group(function () {
      // USERS ROUTE
      Route::get('/user/', [UserController::class, 'index'])->name("user.home");
      Route::get('/user/create', [UserController::class, 'create'])->name("user.create");
      Route::post('/user/create', [UserController::class, 'createPost'])->name("user.createPost");
      Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name("user.edit");
      Route::put('/user/{user}/edit', [UserController::class, 'editPost'])->name("user.editPost");
      Route::delete('/user/{user}/hapus', [UserController::class, 'hapus'])->name("user.hapus");
    });

    Route::middleware(['can:super'])->group(function () {
      // ROLE ROUTE
      Route::get('/role/', [RoleController::class, 'index'])->name("role.home");
      Route::get('/role/create', [RoleController::class, 'create'])->name("role.create");
      Route::post('/role/create', [RoleController::class, 'createPost'])->name("role.createPost");
      Route::get('/role/{role}/edit', [RoleController::class, 'edit'])->name("role.edit");
      Route::put('/role/{role}/edit', [RoleController::class, 'editPost'])->name("role.editPost");
    });

    Route::middleware(['cekRole:admin,super'])->group(function () {
      // KENDARAAN ROUTE
      Route::get('/kendaraan/', [KendaraanController::class, 'index'])->name("kendaraan.home");
      Route::get('/kendaraan/create', [KendaraanController::class, 'create'])->name("kendaraan.create");
      Route::post('/kendaraan/create', [KendaraanController::class, 'createPost'])->name("kendaraan.createPost");
      Route::get('/kendaraan/{kendaraan}/edit', [KendaraanController::class, 'edit'])->name("kendaraan.edit");
      Route::put('/kendaraan/{kendaraan}/edit', [KendaraanController::class, 'editPost'])->name("kendaraan.editPost");
      Route::delete('/kendaraan/{kendaraan}/hapus', [KendaraanController::class, 'hapus'])->name("kendaraan.hapus");
    });
      
    Route::middleware(['cekRole:manager,supervisor,super'])->group(function () {
      // PESANAN ROUTE
      Route::get('/pesanan/', [PemesananController::class, 'index'])->name("pesanan.home");
      Route::get('/pesanan/create', [PemesananController::class, 'create'])->name("pesanan.create");
      Route::post('/pesanan/create', [PemesananController::class, 'createPost'])->name("pesanan.createPost");
      Route::put('/pesanan/{pemesanan}/setuju', [PemesananController::class, 'setuju'])->name("pesanan.setuju");
      Route::delete('/pesanan/{pemesanan}/setuju2', [PemesananController::class, 'setuju2'])->name("pesanan.setuju2");
      Route::delete('/pesanan/{pemesanan}/tolak', [PemesananController::class, 'tolak'])->name("pesanan.tolak");
    });

    Route::middleware(['cekRole:admin,super,supervisor,manager'])->group(function () {
      // RIWAYAT ROUTE
      Route::get('/riwayat/', [RiwayatController::class, 'index'])->name("riwayat.home");
    });
});