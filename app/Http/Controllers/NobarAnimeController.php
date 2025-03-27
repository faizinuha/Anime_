<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NobarAnime;
use App\Models\Anime;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class NobarAnimeController extends Controller
{
    /**
     * Menampilkan daftar semua room nonton bareng
     */
    public function index(Request $request)
    {
        $status = $request->get('status');
        $roms = $status ? NobarAnime::where('status', $status)->get() : NobarAnime::all();
        return view('roms.index', compact('roms', 'status'));
    }

    /**
     * Menampilkan formulir pembuatan room baru
     */
    public function create()
    {
        $animes = Anime::all();
        return view('roms.create', compact('animes'));
    }

    /**
     * Menyimpan room nonton bareng baru ke database
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'Key_rom' => 'required|min:5',
            'tanggal_waktu' => 'required',
            'status' => 'required|in:aktif,selesai,dibatalkan',
            'jumlah_peserta' => 'required|integer|min:1',
            'anime_id' => 'required|exists:animes,id',
        ]);

        $user = Auth::user();

        // Membuat room baru
        $nobarAnime = NobarAnime::create([
            'Key_rom' => $request->Key_rom,
            'anime_id' => $request->anime_id,
            'tanggal_waktu' => $request->tanggal_waktu,
            'deskripsi' => $request->deskripsi,
            'jumlah_peserta' => $request->jumlah_peserta,
            'status' => $request->status,
            'user_id' => $user->id,
        ]);

        // Validasi waktu room (tidak boleh lebih dari jam 4 pagi)
        $entryTime = new \DateTime($nobarAnime->tanggal_waktu);
        $fourAMNextDay = new \DateTime('tomorrow 04:00:00');

        if ($entryTime > $fourAMNextDay) {
            $nobarAnime->delete();
            return redirect()->route('roms.index')
                ->with('error', 'Room tidak dapat dibuat karena waktu lebih dari jam 4 pagi.');
        }

        // Menambahkan pembuat sebagai peserta pertama
        $nobarAnime->users()->attach($user->id);

        return redirect()->route('roms.show', $nobarAnime->id)
            ->with('success', 'Room berhasil dibuat dan Anda telah bergabung! Key Room: ' . $nobarAnime->Key_rom);
    }

    /**
     * Menampilkan formulir edit room
     */
    public function edit($id)
    {
        $rom = NobarAnime::findOrFail($id);
        $animes = Anime::all();
        return view('roms.edit', compact('rom', 'animes'));
    }

    /**
     * Memperbarui data room yang ada
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'Key_rom' => 'required|min:6',
            'tanggal_waktu' => 'required',
            'status' => 'required|in:aktif,selesai,dibatalkan',
            'jumlah_peserta' => 'required|integer|min:1',
            'anime_id' => 'required|exists:animes,id',
        ], [
            'Key_rom.required' => 'Kunci room harus diisi',
            'Key_rom.min' => 'Kunci room minimal 6 karakter',
            'tanggal_waktu.required' => 'Tanggal dan waktu harus diisi',
            'status.required' => 'Status harus dipilih',
            'status.in' => 'Status tidak valid',
            'jumlah_peserta.required' => 'Jumlah peserta harus diisi',
            'jumlah_peserta.min' => 'Jumlah peserta minimal 1 orang',
            'anime_id.required' => 'Anime harus dipilih',
            'anime_id.exists' => 'Anime yang dipilih tidak valid'
        ]);

        $rom = NobarAnime::findOrFail($id);
        
        // Format tanggal waktu sebelum update
        $tanggal_waktu = date('Y-m-d H:i:s', strtotime($request->tanggal_waktu));
        
        $rom->update([
            'Key_rom' => $request->Key_rom,
            'anime_id' => $request->anime_id,
            'tanggal_waktu' => $tanggal_waktu,
            'deskripsi' => $request->deskripsi,
            'jumlah_peserta' => $request->jumlah_peserta,
            'status' => $request->status
        ]);

        return redirect()->route('roms.index')
            ->with('success', 'Room berhasil diperbarui!');
    }

    /**
     * Menampilkan detail room dan daftar peserta
     */
    public function show($id)
    {
        $rom = NobarAnime::findOrFail($id);
        $peserta = $rom->users;
        $comments = Comment::where('anime_id', $rom->anime->id)->get();
        
        // Jika user adalah pemilik room, tampilkan Key_rom
        $showKey = Auth::check() && Auth::id() === $rom->user_id;
        
        return view('roms.show', compact('rom', 'peserta', 'comments', 'showKey'));
    }

    /**
     * Keluar dari room nonton bareng
     */
    public function leave($id)
    {
        $rom = NobarAnime::findOrFail($id);
        $user = Auth::user();

        if ($rom->users()->where('user_id', $user->id)->exists()) {
            $rom->users()->detach($user->id);
            $rom->decrement('jumlah_peserta');
        }

        return redirect()->route('roms.index')
            ->with('success', 'Anda telah keluar dari room.');
    }

    /**
     * Bergabung ke room nonton bareng
     */
    public function joinRoom(Request $request, $id)
    {
        $request->validate([
            'Key_rom' => 'required|string',
        ]);

        $rom = NobarAnime::findOrFail($id);
        $user = Auth::user();

        // Tambah logging untuk debug
        Log::info('Input Key:', ['input' => $request->Key_rom]);
        Log::info('Stored Key:', ['stored' => $rom->Key_rom]);
        Log::info('Comparison:', ['equal' => $request->Key_rom === $rom->Key_rom]);

        // Cek apakah user sudah bergabung
        if ($rom->users()->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'Anda sudah bergabung di room ini.');
        }

        // Validasi key room (case sensitive dan trim whitespace)
        if (trim($request->Key_rom) === trim($rom->Key_rom)) {
            // Cek apakah jumlah peserta sudah mencapai batas
            if ($rom->users()->count() >= $rom->jumlah_peserta) {
                return redirect()->back()->with('error', 'Maaf, room sudah penuh.');
            }

            // Tambahkan user ke room
            $rom->users()->attach($user->id);
            $rom->increment('jumlah_peserta');

            return redirect()->route('roms.show', $id)
                ->with('success', 'Selamat! Anda berhasil bergabung ke room ini.');
        }

        return redirect()->back()->with('error', 'Kunci room tidak sesuai. Silakan coba lagi.');
    }

    /**
     * Menampilkan halaman menonton anime bersama
     */
    public function watching($id)
    {
        $rom = NobarAnime::with('anime')->where('id', $id)->firstOrFail();
        return view('Roms.watch-nobar', compact('rom'));
    }

    /**
     * Create a comment for a specific room.
     */
    public function createcomment(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $rom = NobarAnime::findOrFail($id);

        Comment::create([
            'anime_id' => $rom->anime->id,
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return redirect()->route('roms.show', $id)->with('success', 'Comment added successfully!');
    }
}
