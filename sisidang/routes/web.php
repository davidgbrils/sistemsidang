<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalSidangController;
use App\Http\Controllers\FormulirController;

// Dashboard route
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('dosen', DosenController::class);
});

// Jadwal routes for authenticated users
Route::middleware(['auth'])->prefix('jadwal')->name('jadwal.')->group(function () {
    Route::get('/', [JadwalSidangController::class, 'index'])->name('index');
    Route::get('/create', [JadwalSidangController::class, 'create'])->name('create');
    Route::post('/', [JadwalSidangController::class, 'store'])->name('store');
    Route::get('/{jadwal}', [JadwalSidangController::class, 'show'])->name('show');
    Route::get('/{jadwal}/edit', [JadwalSidangController::class, 'edit'])->name('edit');
    Route::put('/{jadwal}', [JadwalSidangController::class, 'update'])->name('update');
    Route::delete('/{jadwal}', [JadwalSidangController::class, 'destroy'])->name('destroy');
    Route::post('/{jadwal}/publish', [JadwalSidangController::class, 'publish'])->name('publish');
});

// Formulir routes
Route::middleware(['auth'])->prefix('formulir')->name('formulir.')->group(function () {
    Route::get('/', [FormulirController::class, 'index'])->name('index');
    Route::get('/{jadwal}', [FormulirController::class, 'show'])->name('show');
    Route::get('/{jadwal}/create/{tipe}', [FormulirController::class, 'create'])->name('create');
    Route::post('/{jadwal}/store/{tipe}', [FormulirController::class, 'store'])->name('store');
    Route::get('/{jadwal}/download/{tipe}', [FormulirController::class, 'download'])->name('download');
    Route::get('/{jadwal}/rekap', [FormulirController::class, 'rekap'])->name('rekap');
});
