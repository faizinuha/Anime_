@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-gray-900">Edit Rom</h1>
            <p class="text-lg text-gray-600">Update the details of your room.</p>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('roms.update', $rom->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="anime_id" class="block text-sm font-medium text-gray-700">Anime</label>
                    <select name="anime_id" id="anime_id" class="block w-full mt-1 p-2 border border-gray-300 rounded-lg">
                        @foreach($animes as $anime)
                            <option value="{{ $anime->id }}" @if($rom->anime_id == $anime->id) selected @endif>{{ $anime->title }}</option>
                        @endforeach
                    </select>
                    @error('anime_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="key_rom" class="block text-sm font-medium text-gray-700">Key Rom</label>
                    <input type="text" name="key_rom" id="key_rom" value="{{ $rom->key_rom }}" class="block w-full mt-1 p-2 border border-gray-300 rounded-lg" placeholder="Enter room key (min. 6 characters)">
                    @error('key_rom')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="tanggal_waktu" class="block text-sm font-medium text-gray-700">Date and Time</label>
                    <input type="datetime-local" name="tanggal_waktu" id="tanggal_waktu" value="{{ date('Y-m-d\TH:i', strtotime($rom->tanggal_waktu)) }}" class="block w-full mt-1 p-2 border border-gray-300 rounded-lg">
                    @error('tanggal_waktu')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="jumlah_peserta" class="block text-sm font-medium text-gray-700">Participants</label>
                    <input type="number" name="jumlah_peserta" id="jumlah_peserta" value="{{ $rom->jumlah_peserta }}" class="block w-full mt-1 p-2 border border-gray-300 rounded-lg" min="1">
                    @error('jumlah_peserta')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" class="block w-full mt-1 p-2 border border-gray-300 rounded-lg">
                        <option value="aktif" @if($rom->status == 'aktif') selected @endif>Active</option>
                        <option value="selesai" @if($rom->status == 'selesai') selected @endif>Finished</option>
                        <option value="dibatalkan" @if($rom->status == 'dibatalkan') selected @endif>Cancelled</option>
                    </select>
                    @error('status')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-200">Update Rom</button>
                </div>
            </form>
        </div>
    </div>
@endsection
