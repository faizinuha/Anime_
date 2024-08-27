<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Comment;
class dashboardController extends Controller
{
   public function index()
   {
      $user = DB::table('users')->count();
      return view('home.index', compact('user'));
   }

   public function show(Anime $anime)
   {
      // $anime = Anime::findOrFail($anime->id);
      // $comment = Comment::all();
      $comment = Comment::where('anime_id', $anime->id)->get();
      return view('Anim.anime', compact('anime','comment'));
      // dd($anime); 
   }

//    public function watch(Anime $anime) {
      
//       return view('Anim.watch', ['anime' => $anime]);
//   }
  
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

   // function login

}
