<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JadwalSidangController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\NilaiSidangController;
use App\Http\Controllers\FormulirController;
use App\Http\Controllers\GantiPengujiController;
use App\Http\Controllers\HonorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Jadwal Sidang - Index and Show for everyone, Manage for admin|kaprodi|staff_ften
    Route::get('/jadwal', [JadwalSidangController::class, 'index'])->name('jadwal.index');
    Route::get('/jadwal/{jadwal}', [JadwalSidangController::class, 'show'])->name('jadwal.show');

    Route::middleware('role:admin|kaprodi|staff_ften')->group(function () {
        Route::get('/jadwal/create', [JadwalSidangController::class, 'create'])->name('jadwal.create');
        Route::post('/jadwal', [JadwalSidangController::class, 'store'])->name('jadwal.store');
        Route::get('/jadwal/{jadwal}/edit', [JadwalSidangController::class, 'edit'])->name('jadwal.edit');
        Route::put('/jadwal/{jadwal}', [JadwalSidangController::class, 'update'])->name('jadwal.update');
        Route::delete('/jadwal/{jadwal}', [JadwalSidangController::class, 'destroy'])->name('jadwal.destroy');
    });

    Route::middleware('role:admin|kaprodi|staff_ften')->group(function () {
        Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
        Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
        Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
        Route::get('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');
        Route::get('/mahasiswa/{mahasiswa}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
        Route::put('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
        Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
        Route::get('/mahasiswa/export', [MahasiswaController::class, 'export'])->name('mahasiswa.export');

        Route::resource('dosen', \App\Http\Controllers\Admin\DosenController::class);

        Route::get('/import', [ImportController::class, 'excel'])->name('import.excel');
        Route::post('/import', [ImportController::class, 'importExcel'])->name('import.store');
        Route::get('/import/template/{type}', [ImportController::class, 'template'])->name('import.template');
    });

    Route::middleware('role:dosen|admin|kaprodi')->group(function () {
        Route::get('/nilai', [NilaiSidangController::class, 'index'])->name('nilai.index');
        Route::get('/nilai/{jadwal}', [NilaiSidangController::class, 'nilai'])->name('nilai.form');
        Route::post('/nilai/{jadwal}', [NilaiSidangController::class, 'store'])->name('nilai.store');
        Route::get('/nilai/rekap', [NilaiSidangController::class, 'rekap'])->name('nilai.rekap');
    });

    Route::get('/formulir', [FormulirController::class, 'index'])->name('formulir.index');
    Route::get('/formulir/{jadwal}', [FormulirController::class, 'show'])->name('formulir.show');
    Route::get('/formulir/{jadwal}/{tipe}', [FormulirController::class, 'create'])->name('formulir.create');
    Route::post('/formulir/{jadwal}/{tipe}', [FormulirController::class, 'store'])->name('formulir.store');
    Route::get('/formulir/{jadwal}/{tipe}/download', [FormulirController::class, 'download'])->name('formulir.download');
    Route::get('/formulir/{jadwal}/rekap', [FormulirController::class, 'rekap'])->name('formulir.rekap');

    // Ganti Penguji - Request for all, Approval for admin|kaprodi
    Route::get('/ganti-penguji', [GantiPengujiController::class, 'index'])->name('penguji.ganti');
    Route::get('/ganti-penguji/{jadwal}', [GantiPengujiController::class, 'ganti'])->name('penguji.form');
    Route::post('/ganti-penguji/{jadwal}', [GantiPengujiController::class, 'store'])->name('penguji.store');
    Route::get('/ganti-penguji/history', [GantiPengujiController::class, 'history'])->name('penguji.history');

    Route::middleware('role:admin|kaprodi')->group(function () {
        Route::post('/ganti-penguji/{ganti}/approve', [GantiPengujiController::class, 'approve'])->name('penguji.approve');
        Route::post('/ganti-penguji/{ganti}/reject', [GantiPengujiController::class, 'reject'])->name('penguji.reject');
    });

    Route::middleware('role:admin|kaprodi|staff_ften')->group(function () {
        Route::get('/honor', [HonorController::class, 'rekap'])->name('honor.rekap');
        Route::get('/honor/export', [HonorController::class, 'export'])->name('honor.export');
    });

    Route::middleware('role:admin')->group(function () {
        Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
        Route::patch('/users/{user}/role', [\App\Http\Controllers\Admin\UserController::class, 'updateRole'])->name('users.update-role');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/notifications', fn() => view('dashboard'))->name('notifications');
    Route::get('/settings', fn() => view('dashboard'))->name('settings');
});

require __DIR__.'/auth.php';