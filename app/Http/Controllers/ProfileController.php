<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;

class ProfileController extends Controller
{
    // Method untuk menampilkan profil pengguna
    public function index()
    {
        $user = Auth::user();
        
        // Cek apakah user punya profil
        $profile = Profile::where('account_id', $user->id)->first();
    
        if (!$profile) {
            // Jika tidak ada, buat profil default
            $profile = Profile::create([
                'account_id' => $user->id,
                // tambahkan atribut profil lainnya
            ]);
        }
    
        $profiles = Profile::with('user')->get(); // Ambil semua profil jika diperlukan
        return view('profile.index', compact('profiles'));
    }
    
    


    // Method untuk menghapus akun
    public function deleteAccount()
    {
        $user = Auth::user();

        if ($user) {
            // Jika ada profil, hapus terlebih dahulu
            if ($user->profile) {
                $user->profile->delete(); // Menghapus profil pengguna
            }

            // Hapus akun pengguna
            $user->delete();

            // Logout setelah penghapusan
            Auth::logout();

            // Redirect ke halaman utama dengan pesan sukses
            return redirect('/')->with('status', 'Akun berhasil dihapus!');
        }

        return redirect()->back()->with('error', 'Tidak ada pengguna yang login.');
    }
}
