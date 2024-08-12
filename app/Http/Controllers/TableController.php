<?php 
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('table.index', compact('user'));
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
            'password' => 'required|string|min:6',
            'role' => 'required|string'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Encrypt password
            'role' => $request->role
        ]);

        return redirect()->route('table')->with('success', 'Berhasil Tambah User');
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
            'role' => 'required|string'
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
        ]);

        return redirect()->route('table')->with('success', 'Berhasil Update User');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('table')->with('success', 'Berhasil Hapus User');
    }
}
