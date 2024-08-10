<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index(){
        $user = User::all();

        return view('table.index',compact('user'));
    }
}
