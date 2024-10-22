@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<div class="container mx-auto mt-10">
    <div class="text-center mb-10">
        <h1 class="text-5xl font-extrabold text-gray-900">Watch Rom</h1>
        <p class="text-lg text-gray-600">Join the room and enjoy watching anime with your friends.</p>
        <form action="{{ route('roms.create') }}" method="get" class="mt-4">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition duration-200">
                Buat Rom
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($roms as $rom)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                <div class="relative">
                    <img src="{{asset('storage/'. $rom->anime->image)}}" alt="Anime Thumbnail" class="w-full h-48 object-cover">
                    <div class="absolute top-0 left-0 bg-opacity-50 bg-black text-white p-2 rounded-br-lg">
                        <h2 class="text-lg font-semibold">{{ $rom->anime->name }}</h2>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 mb-4">{{ $rom->deskripsi ?? 'No description available.' }}</p>

                    <div class="flex justify-between items-center text-sm text-gray-500 mb-4">
                        <span>Status: 
                            @if($rom->status == 'aktif')
                                <span class="text-green-600 font-semibold">Active</span>
                            @elseif($rom->status == 'selesai')
                                <span class="text-blue-600 font-semibold">Finished</span>
                            @else
                                <span class="text-red-600 font-semibold">Cancelled</span>
                            @endif
                        </span>
                        <span>{{ date('F j, Y, g:i A', strtotime($rom->tanggal_waktu)) }}</span>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-500">
                            Participants: <span class="font-semibold">{{ $rom->jumlah_peserta }}</span>
                        </div>
                        <a href="{{ route('roms.show', $rom->id) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-200">
                            Join Room
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
