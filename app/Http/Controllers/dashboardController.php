<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
   public function index()
   {

      $user = DB::table('users')->count();
      return view('home.index', compact('user'));
   }
   public function login2()
   {

      return view('Auth.login2');
   }
   public function register2()
   {

      return view('Auth.register2');
   }
}
