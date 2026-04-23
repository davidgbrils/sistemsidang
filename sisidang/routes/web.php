<?php

require __DIR__.'/auth.php';

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalSidangController;
use App\Http\Controllers\FormulirController;
use App\Http\Controllers\NilaiSidangController;
use App\Http\Controllers\GantiPengujiController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\HonorController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingsController;

// Landing page (first load)
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return view('landing');
})->name('landing');

// Dashboard route (authenticated)
Route::middleware(['auth'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Admin, Kaprodi & Staff FTEN routes
Route::middleware(['auth', 'role:admin|kaprodi|staff_ften'])->prefix('admin')->group(function () {
    Route::resource('dosen', DosenController::class)->names('dosen');
});

// Admin-only routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::patch('users/{user}/role', [UserController::class, 'updateRole'])->name('users.update-role');
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

// Nilai routes
Route::middleware(['auth'])->prefix('nilai')->name('nilai.')->group(function () {
    Route::get('/', [NilaiSidangController::class, 'index'])->name('index');
    Route::get('/{jadwal}/nilai', [NilaiSidangController::class, 'nilai'])->name('nilai');
    Route::post('/{jadwal}/nilai', [NilaiSidangController::class, 'store'])->name('store');
    Route::get('/rekap', [NilaiSidangController::class, 'rekap'])->name('rekap');
});

// Penguji routes
Route::middleware(['auth'])->prefix('penguji')->name('penguji.')->group(function () {
    Route::get('/', [GantiPengujiController::class, 'index'])->name('ganti');
    Route::get('/{jadwal}/ganti', [GantiPengujiController::class, 'ganti'])->name('ganti.form');
    Route::post('/{jadwal}/ganti', [GantiPengujiController::class, 'store'])->name('store');
    Route::post('/approve/{ganti}', [GantiPengujiController::class, 'approve'])->name('approve');
    Route::post('/reject/{ganti}', [GantiPengujiController::class, 'reject'])->name('reject');
    Route::get('/history', [GantiPengujiController::class, 'history'])->name('history');
});

// Mahasiswa routes
Route::middleware(['auth'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/', [MahasiswaController::class, 'index'])->name('index');
    Route::get('/create', [MahasiswaController::class, 'create'])->name('create');
    Route::post('/', [MahasiswaController::class, 'store'])->name('store');
    Route::get('/{mahasiswa}', [MahasiswaController::class, 'show'])->name('show');
    Route::get('/{mahasiswa}/edit', [MahasiswaController::class, 'edit'])->name('edit');
    Route::put('/{mahasiswa}', [MahasiswaController::class, 'update'])->name('update');
    Route::delete('/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('destroy');
    Route::get('/export', [MahasiswaController::class, 'export'])->name('export');
});

// Import routes
Route::middleware(['auth'])->prefix('import')->name('import.')->group(function () {
    Route::get('/excel', [ImportController::class, 'excel'])->name('excel');
    Route::post('/excel', [ImportController::class, 'importExcel'])->name('store');
    Route::get('/template/{type}', [ImportController::class, 'template'])->name('template');
});

// Honor routes
Route::middleware(['auth'])->prefix('honor')->name('honor.')->group(function () {
    Route::get('/rekap', [HonorController::class, 'rekap'])->name('rekap');
    Route::get('/create', [HonorController::class, 'create'])->name('create');
    Route::post('/', [HonorController::class, 'store'])->name('store');
    Route::get('/export', [HonorController::class, 'export'])->name('export');
});

// Notification routes
Route::middleware(['auth'])->prefix('notifications')->name('notifications.')->group(function () {
    Route::get('/', [NotificationController::class, 'index'])->name('index');
    Route::post('/{id}/read', [NotificationController::class, 'markAsRead'])->name('read');
    Route::post('/read-all', [NotificationController::class, 'markAllAsRead'])->name('read-all');
    Route::delete('/{id}', [NotificationController::class, 'destroy'])->name('destroy');
    Route::delete('/', [NotificationController::class, 'clearAll'])->name('clear-all');
});

// Alias route untuk sidebar
Route::middleware(['auth'])->get('/notifications', [NotificationController::class, 'index'])->name('notifications');

// Settings route
Route::middleware(['auth'])->get('/settings', [SettingsController::class, 'index'])->name('settings');
Route::middleware(['auth'])->put('/settings/theme', [SettingsController::class, 'updateTheme'])->name('settings.theme');
