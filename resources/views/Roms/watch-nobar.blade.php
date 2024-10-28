@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<div class="container mx-auto py-8">
        <h2 class="text-3xl font-bold mb-4 text-center text-gray-800">Nonton {{ $rom->anime->title }}</h2>
        
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6">
                <p class="text-gray-600 mb-4">{{ $rom->anime->description }}</p>
                
                <div class="flex justify-center">
                    <video class="w-full rounded-lg" controls>
                        <source src="{{ asset('storage/' . $rom->anime->video) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>

        <div class="flex justify-center mt-4">
            <a href="{{ route('roms.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Kembali ke Daftar Nobar
            </a>
        </div>
    </div>
@endsection
