<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| RUTE AUTENTIKASI UTAMA (JANGAN DIHAPUS)
|--------------------------------------------------------------------------
*/

// Rute untuk tamu (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

// Rute yang butuh autentikasi dasar (harus login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


/*
|--------------------------------------------------------------------------
| GRUP RUTE BERDASARKAN ROLE (HAK AKSES)
|--------------------------------------------------------------------------
*/

// --- GRUP RUTE ADMIN ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Rute Master Data Mata Pelajaran
    Route::resource('mapel', \App\Http\Controllers\Admin\MataPelajaranController::class);
    // Rute Master Data Kelas
    Route::resource('kelas', \App\Http\Controllers\Admin\KelasController::class);
    // Rute Master Data Kelas
    Route::resource('kelas', \App\Http\Controllers\Admin\KelasController::class);
    // Rute Master Data Siswa
    Route::resource('siswa', \App\Http\Controllers\Admin\SiswaController::class);
    // Rute Master Data Guru
    Route::resource('guru', \App\Http\Controllers\Admin\GuruController::class);
    // Rute Master Data Guru
    Route::resource('guru', \App\Http\Controllers\Admin\GuruController::class);
    // Rute Master Penugasan Guru (Baru)
    Route::resource('penugasan', \App\Http\Controllers\Admin\GuruMapelKelasController::class);
});

// --- GRUP RUTE GURU ---
Route::middleware(['auth', 'role:guru'])->prefix('guru')->name('guru.')->group(function () {
    // Nanti rute input presensi masuk ke sini


});

// --- GRUP RUTE BK ---
Route::middleware(['auth', 'role:bk'])->prefix('bk')->name('bk.')->group(function () {
    // Nanti rute catat pelanggaran masuk ke sini
});

// --- GRUP RUTE WAKA KESISWAAN ---
Route::middleware(['auth', 'role:waka_kesiswaan'])->prefix('waka')->name('waka.')->group(function () {
    // Nanti rute persetujuan (approval) pelanggaran masuk ke sini
});

// --- GRUP RUTE KEPALA SEKOLAH ---
Route::middleware(['auth', 'role:kepala_sekolah'])->prefix('kepsek')->name('kepsek.')->group(function () {
    // Nanti rute rekap laporan akhir masuk ke sini
});