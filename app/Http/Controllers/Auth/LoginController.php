<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
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
    public function login(Request $request)
    {
        // Validasi input
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba login dengan remember me
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Redirect ke halaman yang sesuai jika login berhasil
            return redirect()->intended($this->redirectPath()); // menggunakan fungsi redirectPath() agar dinamis
        }

        // Kembalikan ke halaman login jika gagal
        return back()->withInput($request->only('email', 'remember')) // Menyimpan input sebelumnya
            ->withErrors([
                'email' => 'These credentials do not match our records.',
            ]);
    }
    public function logout(Request $request)
    {
        Auth::logout(); // Mengeluarkan pengguna dari sesi

        $request->session()->invalidate(); // Menghapus sesi saat ini
        $request->session()->regenerateToken(); // Regenerasi token CSRF untuk keamanan

        return redirect()->route('Anim'); // Arahkan ke rute 'Anim'
    }
}
