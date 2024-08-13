<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anime;

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
        $animes = Anime::all();
        return view('Anim.index', compact('animes')); // Mengarahkan ke folder Anim/index.blade.php
    }

    public function index()
    {
        return view('home');
    }
  
}
