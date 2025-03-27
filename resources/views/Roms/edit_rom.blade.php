@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 mt-10">
    <div class="text-center mb-10">
        <h1 class="text-5xl font-extrabold text-white mb-4">Edit Rom</h1>
        <p class="text-xl text-gray-200">Perbarui detail room menonton bersama.</p>
    </div>

    <div class="glass-effect rounded-xl p-8 max-w-2xl mx-auto">
        <form action="{{ route('roms.update', $rom->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="anime_id" class="block text-lg font-medium text-white mb-2">Pilih Anime</label>
                <select name="anime_id" id="anime_id" class="w-full bg-white/10 border border-gray-300/30 text-white rounded-lg px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200">
                    @foreach($animes as $anime)
                        <option value="{{ $anime->id }}" class="text-gray-900" @if($rom->anime_id == $anime->id) selected @endif>
                            {{ $anime->title }}
                        </option>
                    @endforeach
                </select>
                @error('anime_id')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="Key_rom" class="block text-lg font-medium text-white mb-2">Kunci Rom</label>
                <input type="text" name="Key_rom" id="Key_rom" value="{{ $rom->Key_rom }}"
                    class="w-full bg-white/10 border border-gray-300/30 text-white rounded-lg px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200" 
                    placeholder="Masukkan kunci room (min. 6 karakter)">
                @error('Key_rom')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tanggal_waktu" class="block text-lg font-medium text-white mb-2">Tanggal dan Waktu</label>
                <input type="datetime-local" name="tanggal_waktu" id="tanggal_waktu" 
                    value="{{ date('Y-m-d\TH:i', strtotime($rom->tanggal_waktu)) }}"
                    class="w-full bg-white/10 border border-gray-300/30 text-white rounded-lg px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200">
                @error('tanggal_waktu')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="jumlah_peserta" class="block text-lg font-medium text-white mb-2">Jumlah Peserta</label>
                <input type="number" name="jumlah_peserta" id="jumlah_peserta" 
                    value="{{ $rom->jumlah_peserta }}" min="1"
                    class="w-full bg-white/10 border border-gray-300/30 text-white rounded-lg px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200"
                    placeholder="Masukkan jumlah maksimal peserta">
                @error('jumlah_peserta')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="status" class="block text-lg font-medium text-white mb-2">Status</label>
                <select name="status" id="status" 
                    class="w-full bg-white/10 border border-gray-300/30 text-white rounded-lg px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200">
                    <option value="aktif" class="text-gray-900" @if($rom->status == 'aktif') selected @endif>Aktif</option>
                    <option value="selesai" class="text-gray-900" @if($rom->status == 'selesai') selected @endif>Selesai</option>
                    <option value="dibatalkan" class="text-gray-900" @if($rom->status == 'dibatalkan') selected @endif>Dibatalkan</option>
                </select>
                @error('status')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ url()->previous() }}" 
                   class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-300">
                    Kembali
                </a>
                <button type="submit" 
                    class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transform hover:scale-105 transition duration-300 ease-in-out shadow-lg">
                    Perbarui Rom
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
