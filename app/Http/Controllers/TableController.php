<?php

namespace App\Http\Controllers;

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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string',
            'status' => 'required|in:FrontEnd,Backend,Server,UI/UX,Service,Mobile,Database,Network,Security,AI',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Encrypt password
            'role' => $request->role,
            'status' => $request->status,
        ]);

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
            'status' => 'required|string'
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
