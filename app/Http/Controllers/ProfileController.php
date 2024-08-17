<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
 
    /**
     * Display the specified resource.
     */public function show()
{
    $user = Auth::user(); // Ambil data pengguna yang sedang login
    return view('user.index', compact('user'));
}

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
    
        // Validasi data
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phoneNumber' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zipCode' => 'nullable|string|max:10',
            'country' => 'nullable|string',
            'language' => 'nullable|string',
            'timeZones' => 'nullable|string',
            'currency' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:800',
        ]);
    
        // Update data pengguna
        $user->first_name = $request->input('firstName');
        $user->last_name = $request->input('lastName');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phoneNumber');
        $user->address = $request->input('address');
        $user->state = $request->input('state');
        $user->zip_code = $request->input('zipCode');
        $user->country = $request->input('country');
        $user->language = $request->input('language');
        $user->time_zones = $request->input('timeZones');
        $user->currency = $request->input('currency');
    
        // Jika ada file gambar yang diupload
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($user->image && Storage::exists($user->image)) {
                Storage::delete($user->image);
            }
    
            // Simpan gambar baru
            $path = $request->file('image')->store('profile_images');
            $user->image = $path;
        }
    
        // Simpan perubahan ke database
        $user->saved();
    
        return redirect()->route('user.index')->with('success', 'Profile updated successfully.');
    }
    
}
