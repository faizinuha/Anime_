<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Exception;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('check.data.exists'); // Tambahkan middleware untuk cek data
    }

    /**
     * Optimized Anime data retrieval with DB connection check caching.
     */
    public function Anim()
    {
        try {
            // Cek apakah status koneksi tersimpan di cache
            $dbConnected = Cache::remember('db_connection_status', 60, function () {
                try {
                    DB::connection()->getPdo(); // Test koneksi ke database
                    return true; // Koneksi berhasil
                } catch (Exception $e) {
                    return false; // Koneksi gagal
                }
            });

            if (!$dbConnected) {
                // Jika koneksi gagal, arahkan ke halaman error koneksi
                return view('errors.no_connection');
            }

            // Mengambil data anime
            $animes = Anime::all(); // Jika koneksi berhasil, lanjutkan query
            return view('Anim.index', compact('animes'));
        } catch (Exception $e) {
            // Tangani semua error lain yang tidak terkait koneksi database
            return view('errors.Jaringandown', ['message' => $e->getMessage()]);
        }
    }

    public function index()
    {
        return view('home');
    }
}
