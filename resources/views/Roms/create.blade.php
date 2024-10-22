@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<div class="container mx-auto mt-10">
    <div class="text-center mb-10">
        <h1 class="text-5xl font-extrabold text-gray-900">Create New Rom</h1>
        <p class="text-lg text-gray-600">Fill in the details to create a new watch room.</p>
    </div>

    <div class="bg-white shadow-lg rounded-lg p-8">
        <form action="{{ route('roms.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="anime_id" class="block text-sm font-medium text-gray-700 mb-2">Anime</label>
                <select name="anime_id" id="anime_id" class="block w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out">
                    @foreach($animes as $anime)
                        <option value="{{ $anime->id }}">{{ $anime->name }}</option>
                    @endforeach
                </select>
                @error('anime_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="key_rom" class="block text-sm font-medium text-gray-700 mb-2">Key Rom</label>
                <input type="text" name="key_rom" id="key_rom" class="block w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out" placeholder="Enter room key (min. 6 characters)">
                @error('key_rom')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="tanggal_waktu" class="block text-sm font-medium text-gray-700 mb-2">Date and Time</label>
                <input type="datetime-local" name="tanggal_waktu" id="tanggal_waktu" class="block w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out" required>
                @error('tanggal_waktu')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <script>
                document.querySelector('form').addEventListener('submit', function(event) {
                    const input = document.getElementById('tanggal_waktu');
                    const dateTime = new Date(input.value);
                    
                    // Convert to 'Y-m-d H:i:s' format
                    const formattedDate = dateTime.toISOString().slice(0, 19).replace('T', ' ');
                    
                    // Set the formatted value back to the input
                    input.value = formattedDate;
                });
            </script>
            

            <div class="mb-6">
                <label for="jumlah_peserta" class="block text-sm font-medium text-gray-700 mb-2">Participants</label>
                <input type="number" name="jumlah_peserta" id="jumlah_peserta" class="block w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out" min="1">
                @error('jumlah_peserta')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" id="status" class="block w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out">
                    <option value="aktif">Active</option>
                    <option value="selesai">Finished</option>
                    <option value="dibatalkan">Cancelled</option>
                </select>
                @error('status')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end mt-8">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">Create Rom</button>
            </div>
        </form>
    </div>
</div>
@endsection
