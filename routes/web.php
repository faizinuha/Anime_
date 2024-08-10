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

// Rute untuk halaman verifikasi
Route::get('/auth/verify', function () {
    return view('auth.verify');
})->name('verification.notice');
Auth::routes(['verify' => true]);
Route::get('/', [HomeController::class, 'Anim'])->name('Anim');
// Otentikasi dengan verifikasi email
// Gunakan ini jika ingin fitur verifikasi email diaktifkan
// Gunakan ini jika tidak butuh verifikasi email
// Auth::routes();

// Rute untuk pengguna yang sudah login dan terverifikasi
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/table', [TableController::class, 'index'])->name('table');
    Route::get('/home', [dashboardController::class, 'index'])->name('home');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); // Logout dengan metode POST
});
// Rute untuk pengguna yang sudah login
// Route::middleware(['auth'])->group(function () {

//     // Rute untuk Admin
//     Route::middleware(['role:is_admin'])->group(function () {
//         Route::get('/user', [UserController::class, 'index'])->name('user');
//         Route::get('/home', [dashboardController::class, 'index'])->name('home');
//         Route::resource('animes', AnimeController::class); // CRUD khusus admin
//         Route::get('/table', [TableController::class, 'index'])->name('table');
//     });

//     // Rute untuk Member
//     Route::middleware(['role:is_member'])->group(function () {
//         Route::get('/', [HomeController::class, 'Anim'])->name('Anim');
//     });

//     // Rute logout untuk semua yang login
//     Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// });

// // Rute untuk tamu (guest)
// Route::middleware(['guest'])->group(function () {
//     Route::get('/login2', [dashboardController::class, 'login2'])->name('login2');
//     Route::get('/register2', [dashboardController::class, 'register2'])->name('register2');
//     Route::get('/', [HomeController::class, 'Anim'])->name('Anim'); // Rute untuk guest
// });

// Rute untuk tamu (guest)
Route::middleware(['guest'])->group(function () {
    Route::get('/login2', [dashboardController::class, 'login2'])->name('login2');
    Route::get('/register2', [dashboardController::class, 'register2'])->name('register2');
});
// anime


Route::resource('categories', CategoryController::class);

Route::resource('animes', AnimeController::class);
