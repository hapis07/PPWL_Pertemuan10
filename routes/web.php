<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PembayaranController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Authentication
Auth::routes([
    'register' => false,
    'reset' => false,
]);

Route::resource('users', UserController::class)
    ->except(['show']);

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Halaman About
Route::get('/about', function () {
    return view('about', [
        'name' => 'M.Al Hafidz F S',
        'email' => 'malhafidzfs2007@mail.ugm.ac.id',
    ]);
});

// Posts
Route::get('/posts', [PostController::class, 'index']);

// Searching Buku
Route::get('/buku/search', [BukuController::class, 'search'])
    ->name('buku.search');

// CRUD Buku
Route::get('/buku', [BukuController::class, 'index'])
    ->name('buku.index');

Route::get('/buku/create', [BukuController::class, 'create'])
    ->name('buku.create');

Route::post('/buku', [BukuController::class, 'store'])
    ->name('buku.store');

Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])
    ->name('buku.edit');

Route::put('/buku/{id}', [BukuController::class, 'update'])
    ->name('buku.update');

Route::delete('/buku/{id}', [BukuController::class, 'destroy'])
    ->name('buku.destroy');

// Pembayaran
Route::get('/pembayaran', [PembayaranController::class, 'index'])
    ->name('pembayaran.index');

// Dashboard setelah login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');