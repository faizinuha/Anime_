@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<div class="container mx-auto px-4 py-8">
    <div class="glass-effect rounded-2xl overflow-hidden shadow-2xl">
        <!-- Header -->
        <div class="relative">
            <div class="h-48 bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center">
                <div class="text-center">
                    <h1 class="text-4xl font-bold text-white mb-2">Buat Room Nonton Bareng</h1>
                    <p class="text-lg text-gray-200">Atur detail room untuk menonton anime bersama teman-teman</p>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="p-8">
            <form action="{{ route('roms.store') }}" method="POST" class="max-w-3xl mx-auto space-y-6">
                @csrf
                
                <!-- Anime Selection -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label for="anime_id" class="block text-lg font-medium text-white mb-2">Pilih Anime</label>
                            <select name="anime_id" id="anime_id" required
                                    class="w-full bg-white/10 border border-gray-300/30 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                <option value="" disabled selected class="text-gray-400">Pilih anime yang akan ditonton</option>
                                @foreach($animes as $anime)
                                    <option value="{{ $anime->id }}" class="text-gray-900">{{ $anime->name }}</option>
                                @endforeach
                            </select>
                            @error('anime_id')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="Key_rom" class="block text-lg font-medium text-white mb-2">Kunci Room</label>
                            <input type="text" name="Key_rom" id="Key_rom" required
                                   class="w-full bg-white/10 border border-gray-300/30 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                   placeholder="Minimal 6 karakter">
                            @error('Key_rom')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="jumlah_peserta" class="block text-lg font-medium text-white mb-2">Jumlah Peserta Maksimal</label>
                            <input type="number" name="jumlah_peserta" id="jumlah_peserta" required min="1"
                                   class="w-full bg-white/10 border border-gray-300/30 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                   placeholder="Masukkan jumlah maksimal peserta">
                            @error('jumlah_peserta')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label for="tanggal_waktu" class="block text-lg font-medium text-white mb-2">Jadwal Nonton</label>
                            <input type="datetime-local" name="tanggal_waktu" id="tanggal_waktu" required
                                   class="w-full bg-white/10 border border-gray-300/30 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            @error('tanggal_waktu')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="status" class="block text-lg font-medium text-white mb-2">Status Room</label>
                            <select name="status" id="status" required
                                    class="w-full bg-white/10 border border-gray-300/30 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                <option value="aktif" class="text-gray-900">Aktif</option>
                                <option value="selesai" class="text-gray-900">Selesai</option>
                                <option value="dibatalkan" class="text-gray-900">Dibatalkan</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="deskripsi" class="block text-lg font-medium text-white mb-2">Deskripsi Room</label>
                            <textarea name="deskripsi" id="deskripsi" rows="3"
                                      class="w-full bg-white/10 border border-gray-300/30 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                      placeholder="Berikan deskripsi singkat tentang room ini..."></textarea>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end mt-8">
                    <button type="submit"
                            class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-8 py-4 rounded-xl text-lg font-semibold hover:from-indigo-600 hover:to-purple-700 transform hover:scale-105 transition duration-300 ease-in-out shadow-lg">
                        <i class="fas fa-plus-circle mr-2"></i>
                        Buat Room
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@if(session('success'))
    <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg" role="alert">
        {{ session('success') }}
    </div>
    <script>
        setTimeout(() => {
            document.querySelector('[role="alert"]').style.display = 'none';
        }, 3000);
    </script>
@endif

@if(session('error'))
    <div class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-xl shadow-lg" role="alert">
        {{ session('error') }}
    </div>
    <script>
        setTimeout(() => {
            document.querySelector('[role="alert"]').style.display = 'none';
        }, 3000);
    </script>
@endif

<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        const input = document.getElementById('tanggal_waktu');
        const dateTime = new Date(input.value);
        const formattedDate = dateTime.toISOString().slice(0, 19).replace('T', ' ');
        input.value = formattedDate;
    });
</script>
@endsection
