@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<div class="container mx-auto px-4 mt-10">
    <div class="text-center mb-12">
        <h1 class="text-6xl font-extrabold text-white mb-4">Watch Rom</h1>
        <p class="text-xl text-gray-200 mb-8">Bergabunglah dengan room dan nikmati menonton anime bersama teman-teman Anda.</p>
        <form action="{{ route('roms.create') }}" method="get">
            <button type="submit" class="bg-indigo-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-indigo-700 transform hover:scale-105 transition duration-300 ease-in-out shadow-lg">
                <span class="flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Buat Rom Baru
                </span>
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($roms as $rom)
            <div class="glass-effect rounded-xl overflow-hidden transform hover:scale-105 transition duration-300 ease-in-out">
                <div class="relative">
                    <img src="{{asset('storage/'. $rom->anime->image)}}" alt="Anime Thumbnail" class="w-full h-56 object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent">
                        <div class="absolute bottom-4 left-4">
                            <h2 class="text-2xl font-bold text-white mb-2">{{ $rom->anime->name }}</h2>
                            <div class="flex items-center space-x-2">
                                <span class="px-3 py-1 rounded-full text-sm 
                                    @if($rom->status == 'aktif') bg-green-500
                                    @elseif($rom->status == 'selesai') bg-blue-500
                                    @else bg-red-500
                                    @endif text-white">
                                    {{ ucfirst($rom->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <p class="text-gray-200 mb-4">{{ $rom->deskripsi ?? 'Tidak ada deskripsi.' }}</p>

                    <div class="flex justify-between items-center mb-4">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            <span class="text-gray-200">{{ $rom->jumlah_peserta }} Peserta</span>
                        </div>
                        <span class="text-gray-200 text-sm">{{ date('d M Y, H:i', strtotime($rom->tanggal_waktu)) }}</span>
                    </div>

                    <a href="{{ route('roms.show', $rom->id) }}" 
                       class="block w-full text-center bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition duration-300 ease-in-out">
                        Gabung Room
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
