<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class dashboardController extends Controller
{
   public function index()
   {
      $user = DB::table('users')->count();
      return view('home.index', compact('user'));
   }
   public function data()
   {
      // Menghitung jumlah Anime dan User
      $animeCount = Anime::count();
      $userCount = User::count();

      // Mengirim data ke view 'home.Dates'
      return view('home.Dates', compact('animeCount', 'userCount'));
   }


   public function list()
   {
      $animes = Anime::all();
      return view('Anim.list', compact('animes'));
   }
   public function genre() {

      $animes = Anime::all();
      return view('Anim.category',compact('animes'));
   }
   
   // function login
   public function login2()
   {
      
      return view('Auth.loginUser');
      // return view('Auth.login2');
   }
   public function register2()
   {
      return view('Auth.registeruser');
      // return view('Auth.register2');
   }
}
