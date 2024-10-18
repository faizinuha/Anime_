
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
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SearchController;
use App\Http\controllers\watchController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookmarksController;
// use App\Http\Controllers\Tayangharicontroller;

// Rute untuk halaman verifikasi email

// Ganti nama route ini untuk menghindari konflik
Route::get('/auth/verify', function () {
    return view('auth.verify');
})->name('custom.verification.notice'); // Mengganti nama route
// Otentikasi dengan verifikasi email diaktifkan
Auth::routes(['verify' => true]);
// offline

Route::get('Jaringandown', function () {
    return view('errors.Jaringandown');
});


// online
// ===============================[Bagian data akun]=============================================//
Route::get('/', [HomeController::class, 'Anim'])->name('Anim');
Route::get('/list', [dashboardController::class, 'list'])->name('list');

Route::get('/watch/{watch:name}-{episode}', [WatchController::class, 'show'])->name('anime.show');
// Route::get('/watch/{name}', [WatchController::class, 'show'])->name('anime.show');
Route::get('/anime/{anime:name}', [DashboardController::class, 'show'])->name('animes.show');

Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');

Route::post('/reply', [ReplyController::class, 'reply'])->name('reply.store');

// ===============================[akhir]=============================================//

// Rute yang dapat diakses tanpa login
// ===============================[Bagian data akun]=============================================//
// Rute untuk pengguna yang sudah login dan terverifikasi
// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// });

// Rute login hanya untuk guest
Route::middleware(['guest'])->group(function () {
    Route::get('/loginuser', [LoginController::class, 'login2'])->name('login2');
    Route::get('/registeruser', [LoginController::class, 'register2'])->name('register2');
});
Route::post('/bookmarks', [BookmarksController::class, 'store'])->name('bookmarks.store');
Route::delete('/bookmarks/{animeId}', [BookmarksController::class, 'destroy'])->name('bookmarks.destroy');

//==============================================[user dan admin]===============================================
// Route::get('/animes/{anime:name}', [AnimeController::class, 'show'])->name('animes.show');
//==============================================[user dan admin]===============================================
// Rute logout untuk pengguna yang sudah login
Route::middleware(['auth'])->post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route untuk menampilkan profil pengguna
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index')->middleware('auth');

// Route untuk hapus akun
Route::delete('/profile/delete-account', [ProfileController::class, 'deleteAccount'])
    ->name('profile.delete-account')
    ->middleware('auth');

// Route::resource('animes', AnimeController::class);
Route::middleware(['auth', 'role:is_admin'])->group(function () {
    Route::get('/home', [dashboardController::class, 'index'])->name('home');
    Route::get('/Data', [dashboardController::class, 'data'])->name('home.Dates');
    Route::resource('categories', CategoryController::class);
    Route::get('/table', [TableController::class, 'index'])->name('table');



    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    // ========================[ Bagian crud]================================//
    // Route::resource('jadwals', JadwalController::class);

    // Route::resource('Tayanghari', Tayangharicontroller::class);
    Route::resource('table', TableController::class);

    // web search


    Route::get('/search', [SearchController::class, 'search'])->name('search');
    // use App\Http\Controllers\AnimeController;
    // Menampilkan daftar anime
    Route::get('/animes', [AnimeController::class, 'index'])->name('anime.index');
    // Menampilkan form untuk membuat anime baru
    Route::get('/animes/create', [AnimeController::class, 'create'])->name('anime.create');
    // Menyimpan anime baru ke database
    Route::post('/animes', [AnimeController::class, 'store'])->name('anime.store');
    // Menampilkan form untuk mengedit anime tertentu
    Route::get('/animes/{id}/edit', [AnimeController::class, 'edit'])->name('anime.edit');
    // Memperbarui anime tertentu di database
    Route::put('/animes/{id}', [AnimeController::class, 'update'])->name('anime.update');
    // Menghapus anime tertentu dari database
    Route::delete('/animes/{id}', [AnimeController::class, 'destroy'])->name('anime.destroy');






    // bagian episode
    Route::get('/episodes', [EpisodeController::class, 'index'])->name('episodes.index');
    Route::get('/episodes/create', [EpisodeController::class, 'create'])->name('episodes.create');
    Route::post('/episodes', [EpisodeController::class, 'store'])->name('episodes.store');
    Route::delete('/episodes/{id}', [EpisodeController::class, 'destroy'])->name('episodes.destroy');

    Route::get('/NewEps', [EpisodeController::class, 'newEps'])->name('episode.newEps');
    Route::post('/neweps/create', [EpisodeController::class, 'createEps'])->name('episodes.createEps');
});
