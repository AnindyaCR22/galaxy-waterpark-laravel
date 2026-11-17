<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\GalleryController;

// Redirect halaman root (/) ke /home (otomatis ke /login jika belum login)
Route::get('/', function () {
    return redirect('/home');
});

Auth::routes([
    'register' => false,
    'reset'    => false,
]);

// 1. Rute yang bisa diakses SEMUA user yang SUDAH LOGIN (admin & user biasa)
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/tiket', [TiketController::class, 'index'])->name('tiket.index');
    Route::get('/tiket/search', [TiketController::class, 'search'])->name('tiket.search');

    // Rute Katalog & Detail SEO Tiket (Modul BAB X)
    Route::get('/katalog-tiket', [TiketController::class, 'listTiket'])->name('tiket.katalog');
    Route::get('/detail-tiket/{title}', [TiketController::class, 'galtiket'])->name('galeri.tiket');

    // Rute Lihat Galeri Wahana (Modul Gallery)
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
});

// 2. Rute KHUSUS ADMIN (Kelola Tiket, Users, Jobs, dan Galeri)
Route::middleware(['auth', 'admin'])->group(function () {
    // Kelola Tiket (Tambah, Edit, Hapus)
    Route::get('/tiket/create', [TiketController::class, 'create'])->name('tiket.create');
    Route::post('/tiket', [TiketController::class, 'store'])->name('tiket.store');
    Route::get('/tiket/{id}/edit', [TiketController::class, 'edit'])->name('tiket.edit');
    Route::put('/tiket/{id}', [TiketController::class, 'update'])->name('tiket.update');
    Route::delete('/tiket/{id}', [TiketController::class, 'destroy'])->name('tiket.destroy');

    // CRUD Users
    Route::resource('users', UserController::class);

    // CRUD Lowongan Kerja (Jobs)
    Route::resource('jobs', JobController::class);

    // Kelola Galeri Wahana (Tambah, Edit, Hapus)
    Route::resource('gallery', GalleryController::class)->except(['index', 'show']);
});
