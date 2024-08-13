<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rute untuk halaman verifikasi email
// Ganti nama route ini untuk menghindari konflik
Route::get('/auth/verify', function () {
    return view('auth.verify');
})->name('custom.verification.notice'); // Mengganti nama route
// Otentikasi dengan verifikasi email diaktifkan
Auth::routes(['verify' => true]);

// ===============================[Bagian data akun]=============================================//
Route::get('/', [HomeController::class, 'Anim'])->name('Anim');
Route::get('/list', [dashboardController::class, 'list'])->name('list');
// ===============================[akhir]=============================================//

// Rute yang dapat diakses tanpa login
// ===============================[Bagian data akun]=============================================//
// Rute untuk pengguna yang sudah login dan terverifikasi
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
// Rute login hanya untuk guest
Route::middleware(['guest'])->group(function () {
    Route::get('/login2', [dashboardController::class, 'login2'])->name('login2');
    Route::get('/register2', [dashboardController::class, 'register2'])->name('register2');
});
// Rute logout untuk pengguna yang sudah login
Route::middleware(['auth', 'verified'])->post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth','role:is_admin'])->group(function () {
    Route::get('/home', [dashboardController::class, 'index'])->name('home');
    Route::get('/Data', [dashboardController::class, 'data'])->name('home.Dates');
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::resource('categories', CategoryController::class);
    Route::resource('animes', AnimeController::class);
    Route::get('/table', [TableController::class, 'index'])->name('table');
});
// ========================[ Bagian crud]================================//
Route::resource('jadwals', JadwalController::class);
Route::resource('table', TableController::class);

// // Route untuk menampilkan formulir tambah data
// Route::get('/table/create', [TableController::class, 'create'])->name('table.create');
// // Route untuk menyimpan data baru
// Route::post('/table', [TableController::class, 'store'])->name('table.store');
// // Route untuk menampilkan formulir edit data
// Route::get('/table/{id}/edit', [TableController::class, 'edit'])->name('table.edit');
// // Route untuk memperbarui data
// Route::put('/table/{id}', [TableController::class, 'update'])->name('table.update');
// // Route untuk menghapus data
// Route::delete('/table/{id}', [TableController::class, 'destroy'])->name('table.destroy');