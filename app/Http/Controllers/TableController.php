<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('table.index', compact('users'));
    }

    public function create()
    {
        return view('table.create');
    }

    public function store(Request $request)
    {
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255|unique:users,name',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
        'role' => 'required|string',
        'status' => 'required|in:FrontEnd,Backend,Server,UI/UX,Service,Mobile,Database,Network,Security,AI',
    ]);

    // Cek apakah validasi gagal
    if ($validator->fails()) {
        // Cek data Jika di ada
        if ($validator->errors()->has('name')) {
            return redirect()->back()->withErrors(['name' => 'Maaf, Nama sudah digunakan!'])->withInput();
        }
        // Jika ada error lain, kembalikan semua error ke form sebelumnya
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Jika validasi berhasil,
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password), // Enkripsi password
        'role' => $request->role,
        'status' => $request->status,
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('table.index')->with('success', 'Berhasil Tambah User');
}

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('table.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed', // Password tidak wajib diubah
            'role' => 'required|string',
            'status' => 'required|in:FrontEnd,Backend,Server,UI/UX,Service,Mobile,Database,Network,Security,AI',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password, // Hanya update password jika diisi
            'role' => $request->role,
            'status' => $request->status
        ]);

        return redirect()->route('table.index')->with('success', 'Berhasil Update User');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('table.index')->with('success', 'Berhasil Hapus User');
    }
}
