<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
Route::get('/auth/verify', function () {
    return view('auth.verify');
})->name('verification.notice');

// Otentikasi dengan verifikasi email diaktifkan
Auth::routes(['verify' => true]);

// Rute yang dapat diakses tanpa login
Route::get('/', [HomeController::class, 'Anim'])->name('Anim');
// Rute untuk pengguna yang sudah login dan terverifikasi
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/table', [TableController::class, 'index'])->name('table');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Rute untuk tamu (guest) - Dapat mengakses halaman login dan register
Route::middleware(['guest'])->group(function () {
    Route::get('/login2', [dashboardController::class, 'login2'])->name('login2');
    Route::get('/register2', [dashboardController::class, 'register2'])->name('register2');
});

Route::get('/', [HomeController::class, 'Anim'])->name('Anim'); // Dapat diakses tanpa login

Route::middleware(['auth', 'verified', 'role:is_admin'])->group(function () {
    Route::get('/home', [dashboardController::class, 'index'])->name('home');
    Route::resource('categories', CategoryController::class);
    Route::resource('animes', AnimeController::class);
});
