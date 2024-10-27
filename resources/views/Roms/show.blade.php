<!-- resources/views/roms/show.blade.php -->

@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>

<div class="container mx-auto mt-10">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="relative">
            @if(isset($rom->anime))
            <img src="{{ asset('storage/' . $rom->anime->image) }}" alt="Anime Thumbnail" class="w-full h-64 object-cover">
            <h1 class="text-4xl font-bold">{{ $rom->anime->name }}</h1>
        @else
            <p>Anime data is not available for this room.</p>
        @endif
        
            <div class="absolute top-0 left-0 bg-opacity-75 bg-black text-white p-4 rounded-br-lg">
                <h1 class="text-4xl font-bold">{{ $rom->anime->name }}</h1>
                <p class="text-lg">{{ date('F j, Y, g:i A', strtotime($rom->tanggal_waktu)) }}</p>
            </div>
        </div>
        <div class="p-6">
            <h2 class="text-3xl font-semibold mb-4">Room Information</h2>
            <p class="text-lg text-gray-700 mb-6">{{ $rom->deskripsi ?? 'No description available.' }}</p>

            <div class="flex justify-between items-center mb-6">
                <div class="text-gray-600">
                    <p>Nama Ketua: {{ $rom->ketua->name }}</p>
                    <p><strong>Status:</strong> 
                        @if($rom->status == 'aktif')
                            <span class="text-green-600 font-semibold">Active</span>
                        @elseif($rom->status == 'selesai')
                            <span class="text-blue-600 font-semibold">Finished</span>
                        @else
                            <span class="text-red-600 font-semibold">Cancelled</span>
                        @endif
                    </p>
                    <p><strong>Participants:</strong> {{ $rom->jumlah_peserta }}</p>
                </div>
            </div>

            <div class="bg-gray-100 p-4 rounded-lg">
                <h3 class="text-2xl font-semibold mb-2">Chat Room</h3>
                <!-- Chat room content will be here -->
                <p class="text-gray-600">Chat functionality coming soon...</p>
            </div>
        </div>
    </div>
</div>
@endsection
