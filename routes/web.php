<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    EpisodeController,
    ReplyController,
    ProfileController,
    BookmarksController,
    NobarAnimeController
};


// =================================[AUTH ROUTES]===============================================

// Custom route untuk halaman verifikasi email
Route::get('/auth/verify', fn() => view('auth.verify'))->name('custom.verification.notice');
Auth::routes(['verify' => true]);  // Otentikasi dengan verifikasi email


// Halaman Jaringan Down (offline)
Route::get('Jaringandown', fn() => view('errors.Jaringandown'));

// =================================[PUBLIC ROUTES]===============================================

// Halaman Utama dan List
Route::get('/', [HomeController::class, 'Anim'])->name('Anim');
Route::get('/list', [dashboardController::class, 'list'])->name('list');

// Menonton dan Komentar
Route::get('/watch/{watch:name}-{episode}', [WatchController::class, 'show'])->name('anime.show');
Route::get('/anime/{anime:name}', [dashboardController::class, 'show'])->name('animes.show');

Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.store');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');

// Membalas Komentar
Route::post('/reply', [ReplyController::class, 'reply'])->name('reply.store');

// Bookmark
Route::post('/bookmarks', [BookmarksController::class, 'store'])->name('bookmarks.store');
Route::delete('/bookmarks/{animeId}', [BookmarksController::class, 'destroy'])->name('bookmarks.destroy');

// Nobar Anime (Rom)
Route::get('/roms', [NobarAnimeController::class, 'index'])->name('roms.index');
Route::get('/roms/{id}/show', [NobarAnimeController::class, 'show'])->name('roms.show');
Route::post('/roms/{id}/join', [NobarAnimeController::class, 'joinRoom'])->name('roms.join');
Route::get('/roms/{id}/leave', [NobarAnimeController::class, 'leave'])->name('roms.leave');
Route::get('/roms/create', [NobarAnimeController::class, 'create'])->name('roms.create');
Route::post('/roms', [NobarAnimeController::class, 'store'])->name('roms.store');
Route::get('/roms/{rom}/edit', [NobarAnimeController::class, 'edit'])->name('roms.edit');
Route::put('/roms/{rom}', [NobarAnimeController::class, 'update'])->name('roms.update');
Route::get('/watching/{rom}', [NobarAnimeController::class, 'watching'])->name('roms.watching');
// Rute untuk komentar
Route::post('/roms/{id}/comments', [NobarAnimeController::class, 'createcomment'])->name('roms.comments.create');

// =================================[GUEST ONLY ROUTES]===============================================

Route::middleware(['guest'])->group(function () {
    Route::get('/loginuser', [LoginController::class, 'login2'])->name('login2');
    Route::get('/registeruser', [LoginController::class, 'register2'])->name('register2');
});

// =================================[AUTH ONLY ROUTES]===============================================

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Akun Pengguna
    Route::delete('/account/delete-account', [UserController::class, 'deleteAccount'])->name('account.delete-account');
    Route::get('/account', [UserController::class, 'account'])->name('account');
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
});

// =================================[ADMIN ONLY ROUTES]===============================================

Route::middleware(['auth', 'role:is_admin'])->group(function () {
    // Dashboard dan Data
    Route::get('/home', [dashboardController::class, 'index'])->name('home');
    Route::get('/Data', [dashboardController::class, 'data'])->name('home.Dates');

    // Kategori
    Route::resource('categories', CategoryController::class);

    // Tabel
    Route::get('/table', [TableController::class, 'index'])->name('table');

    Route::resource('table', TableController::class);

    // Pencarian
    Route::get('/search', [SearchController::class, 'search'])->name('search');

    // Anime CRUD
    Route::get('/animes', [AnimeController::class, 'index'])->name('anime.index');
    Route::get('/animes/create', [AnimeController::class, 'create'])->name('anime.create');
    Route::post('/animes', [AnimeController::class, 'store'])->name('anime.store');
    Route::get('/animes/{id}/edit', [AnimeController::class, 'edit'])->name('anime.edit');
    Route::put('/animes/{id}', [AnimeController::class, 'update'])->name('anime.update');
    Route::delete('/animes/{id}', [AnimeController::class, 'destroy'])->name('anime.destroy');

    // Episode CRUD
    Route::get('/episodes', [EpisodeController::class, 'index'])->name('episodes.index');
    Route::get('/episodes/create', [EpisodeController::class, 'create'])->name('episodes.create');
    Route::post('/episodes', [EpisodeController::class, 'store'])->name('episodes.store');
    Route::delete('/episodes/{id}', [EpisodeController::class, 'destroy'])->name('episodes.destroy');
    Route::get('/NewEps', [EpisodeController::class, 'newEps'])->name('episode.newEps');
    Route::post('/neweps/create', [EpisodeController::class, 'createEps'])->name('episodes.createEps');
});
