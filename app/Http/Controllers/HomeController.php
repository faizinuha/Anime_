<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anime;
use Exception;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('check.data.exists'); // Tambahkan middleware untuk cek data
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function Anim()
    {
        try {
            // MeCoba lakukan query untuk cek koneksi database
            DB::connection()->getPdo(); // Test koneksi ke database
            $animes = Anime::all();
            return view('Anim.index', compact('animes')); 
        } catch (Exception $e) {
            // Jika ada exception (koneksi gagal), tampilkan halaman khusus
            if ($e->getCode() == 2002) {
                return view('errors.no_connection'); // Tampilkan halaman periksa koneksi internet
            }
            return view('errors.generic_error', ['message' => $e->getMessage()]); // Untuk error lainnya
        }
    }
    

    public function index()
    {
        return view('home');
    }
  
}
