<?php

use App\Http\Controllers\{
    dashboardController,
    TableController,
    UserController,
    Auth\LoginController,
    AnimeController,
    HomeController,
    CategoryController,
    CommentController,
    SearchController,
    WatchController,
    EpisodeController
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Rute untuk halaman verifikasi email
Route::get('/auth/verify', function () {
    return view('auth.verify');
})->name('custom.verification.notice');

// Otentikasi dengan verifikasi email diaktifkan
Auth::routes(['verify' => true]);

Route::get('Jaringandown', function () {
    return view('errors.Jaringandown');
});

// ===============================[Bagian data akun]=============================================//
Route::get('/', [HomeController::class, 'Anim'])->name('Anim');
Route::get('/list', [dashboardController::class, 'list'])->name('list');
Route::get('/watch/{watch:name}-{episode}', [WatchController::class, 'show'])->name('anime.show');

// Rute untuk komentar
Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');

// ===============================[Akses Tanpa Login]============================================//
Route::middleware(['guest'])->group(function () {
    Route::get('/loginuser', [LoginController::class, 'login2'])->name('login2');
    Route::get('/registeruser', [LoginController::class, 'register2'])->name('register2');
});

// Rute untuk pengguna yang sudah login
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// ===============================[Akses untuk Admin]============================================//
Route::middleware(['auth', 'role:is_admin'])->group(function () {
    Route::get('/home', [dashboardController::class, 'index'])->name('home');
    Route::get('/Data', [dashboardController::class, 'data'])->name('home.Dates');
    Route::resource('categories', CategoryController::class);
    Route::resource('table', TableController::class);
});

// ===============================[Rute Anime]============================================//
Route::resource('animes', AnimeController::class);

// ===============================[Rute Episode]============================================//
Route::resource('episodes', EpisodeController::class);

// ===============================[Rute Pencarian]============================================//
Route::get('/search', [SearchController::class, 'search'])->name('search');
