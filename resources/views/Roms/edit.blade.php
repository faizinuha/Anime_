@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<div class="container mx-auto px-4 py-8">
    <div class="glass-effect rounded-2xl overflow-hidden shadow-2xl p-8">
        <div class="flex items-center mb-6">
            <i class="fas fa-edit text-3xl text-white mr-3"></i>
            <h2 class="text-3xl font-bold text-white">Edit Room</h2>
        </div>

        @if ($errors->any())
            <div class="mb-6 bg-red-500/10 border border-red-500/50 rounded-xl p-4">
                <ul class="list-disc list-inside text-red-200">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('roms.update', $rom->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div>
                        <label for="anime_id" class="block text-white text-sm font-medium mb-2">Pilih Anime</label>
                        <select name="anime_id" id="anime_id" class="w-full bg-white/10 border border-gray-300/30 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent" required>
                            @foreach($animes as $anime)
                                <option value="{{ $anime->id }}" {{ $rom->anime_id == $anime->id ? 'selected' : '' }}>
                                    {{ $anime->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="Key_rom" class="block text-white text-sm font-medium mb-2">Kunci Room</label>
                        <input type="text" name="Key_rom" id="Key_rom" value="{{ $rom->Key_rom }}" 
                               class="w-full bg-white/10 border border-gray-300/30 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                               required minlength="6"
                               placeholder="Minimal 6 karakter">
                    </div>

                    <div>
                        <label for="tanggal_waktu" class="block text-white text-sm font-medium mb-2">Tanggal dan Waktu Mulai</label>
                        <input type="datetime-local" name="tanggal_waktu" id="tanggal_waktu" 
                               value="{{ date('Y-m-d\TH:i', strtotime($rom->tanggal_waktu)) }}"
                               class="w-full bg-white/10 border border-gray-300/30 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                               required>
                        <p class="text-sm text-gray-300 mt-1">Format: DD/MM/YYYY JJ:MM</p>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <div>
                        <label for="status" class="block text-white text-sm font-medium mb-2">Status Room</label>
                        <select name="status" id="status" class="w-full bg-white/10 border border-gray-300/30 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent" required>
                            <option value="aktif" {{ $rom->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="selesai" {{ $rom->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="dibatalkan" {{ $rom->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>

                    <div>
                        <label for="jumlah_peserta" class="block text-white text-sm font-medium mb-2">Jumlah Peserta Maksimal</label>
                        <input type="number" name="jumlah_peserta" id="jumlah_peserta" value="{{ $rom->jumlah_peserta }}"
                               class="w-full bg-white/10 border border-gray-300/30 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                               required min="1">
                    </div>

                    <div>
                        <label for="deskripsi" class="block text-white text-sm font-medium mb-2">Deskripsi Room</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" 
                                  class="w-full bg-white/10 border border-gray-300/30 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                  placeholder="Tambahkan deskripsi room di sini...">{{ $rom->deskripsi }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-4 mt-6">
                <a href="{{ route('roms.show', $rom->id) }}" 
                   class="px-6 py-3 bg-gray-500 text-white rounded-xl hover:bg-gray-600 transition">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-green-500 text-white rounded-xl hover:bg-green-600 transition">
                    Perbarui Room
                </button>
            </div>
        </form>
    </div>
</div>
@endsection