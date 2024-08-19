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
use App\Http\Controllers\SearchController;
// use App\Models\Anime;
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
Route::get('/anime/{anime:name}', [DashboardController::class, 'show'])->name('animes.show');
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
//==============================================[user dan admin]===============================================
// Route::get('/animes/{anime:name}', [AnimeController::class, 'show'])->name('animes.show');
Route::get('/animes', [AnimeController::class, 'index'])->name('animes.index');
Route::get('/animes/create', [AnimeController::class, 'create'])->name('animes.create');
Route::post('/animes', [AnimeController::class, 'store'])->name('animes.store');
Route::get('/animes/{anime}/edit', [AnimeController::class, 'edit'])->name('animes.edit');
Route::delete('/animes/{anime}', [AnimeController::class, 'destroy'])->name('animes.destroy');
//==============================================[user dan admin]===============================================
// Rute logout untuk pengguna yang sudah login
Route::middleware(['auth'])->post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::resource('animes', AnimeController::class);
Route::middleware(['auth','role:is_admin'])->group(function () {
    Route::get('/home', [dashboardController::class, 'index'])->name('home');
    Route::get('/Data', [dashboardController::class, 'data'])->name('home.Dates');
    Route::resource('categories', CategoryController::class);
    Route::get('/table', [TableController::class, 'index'])->name('table');
});

Route::get('/user', [UserController::class, 'index'])->name('user');
// ========================[ Bagian crud]================================//
// Route::resource('jadwals', JadwalController::class);
Route::resource('table', TableController::class);

// web search


Route::get('/search', [SearchController::class, 'search'])->name('search');

// Route::get('/search', function (Illuminate\Http\Request $request) {
//     $query = $request->input('query');
//     $results = Anime::where('name', 'LIKE', "%{$query}%")->get(); // Ganti 'name' dengan kolom yang sesuai

//     return view('src.search-results', compact('results'));
// })->name('search');