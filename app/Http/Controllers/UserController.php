<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Menampilkan halaman profil
    public function index()
    {
        $profile = Auth::user(); // Ambil pengguna yang sedang login
        return view('user.index', compact('profile'));
    }
    public function account()
    {
        // Mengambil data pengguna yang sedang login
        $user =  Auth::user(); // Mengambil semua data pengguna
        return view('profile.index', compact('user'));
    }

    // Menampilkan halaman edit profil
    public function edit($id)
    {
        $user = User::findOrFail($id); // Retrieve user by ID
        return view('user.edit', compact('user'));
    }

    // Menyimpan perubahan profil
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:800', // Validasi foto
        ]);

        $user = User::findOrFail($id); // Temukan user berdasarkan ID
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Menangani upload foto
        if ($request->hasFile('photo')) {
            // Simpan file ke direktori storage/public/profile_photos
            $path = $request->file('photo')->store('profile_photos', 'public');
            $user->photo = $path; // Simpan path foto di database
        }

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('user')->with('success', 'Profil berhasil diperbarui.');
    }
    public function deleteAccount()
    {
        $user = Auth::user(); // Ambil pengguna yang sedang login

        if ($user) {
            // Jika pengguna memiliki data profil terkait, hapus profil terlebih dahulu
            if ($user->profile) {
                $user->profile->delete(); // Hapus profil pengguna
            }

            // Hapus akun pengguna
            $user->delete();

            // Logout setelah penghapusan akun
            Auth::logout();

            // Redirect ke halaman utama dengan pesan sukses
            return redirect('/')->with('status', 'Akun berhasil dihapus!');
        }

        // Jika tidak ada pengguna yang login, kembalikan pesan error
        return redirect()->back()->with('error', 'Tidak ada pengguna yang login.');
    }
}
