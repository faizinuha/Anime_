<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\CustomPasswordResetNotification;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function resetpassword(Request $request, User $user)
    {
        // Kirim notifikasi kustom
         $user->notify(new CustomPasswordResetNotification());
    
        // Flash notifikasi ke sesi dengan pesan unik
        session()->flash('notification', "Halo, {$user->name}! Sepertinya kamu lupa password ya? Jangan khawatir, kita semua pernah kok. Yuk, reset sekarang sebelum kamu lupa lagi!");
    
        return view('auth.passwords.reset');
    }
    
}    
