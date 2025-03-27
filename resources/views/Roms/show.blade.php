@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<div class="container mx-auto px-4 py-8">
    <div class="glass-effect rounded-2xl overflow-hidden shadow-2xl">
        <!-- Header Image & Title -->
        <div class="relative">
            @if(isset($rom->anime))
                <img src="{{ asset('storage/' . $rom->anime->image) }}" alt="Anime Thumbnail" class="w-full h-80 object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent">
                    <div class="absolute bottom-6 left-6">
                        <h1 class="text-5xl font-bold text-white mb-3">{{ $rom->anime->name }}</h1>
                        <div class="flex items-center gap-4">
                            <p class="text-lg text-gray-200">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                {{ date('F j, Y, g:i A', strtotime($rom->tanggal_waktu)) }}
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="h-48 flex items-center justify-center">
                    <p class="text-center text-gray-200 p-4">Anime data is not available for this room.</p>
                </div>
            @endif
        </div>

        <!-- Room Information -->
        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h2 class="text-2xl font-bold text-white mb-4">Room Information</h2>
                    <div class="space-y-4 text-gray-200">
                        <p class="text-lg">{{ $rom->deskripsi ?? 'No description available.' }}</p>
                        <div class="flex items-center gap-2">
                            <span class="font-bold">Room Leader:</span>
                            <span>{{ $rom->ketua->name }}</span>
                        </div>
                        @if($showKey)
                        <div class="flex items-center gap-2">
                            <span class="font-bold">Room Key:</span>
                            <span class="bg-white/10 px-3 py-1 rounded-lg">{{ $rom->Key_rom }}</span>
                        </div>
                        @endif
                        <div class="flex items-center gap-2">
                            <span class="font-bold">Status:</span>
                            @if($rom->status == 'aktif')
                                <span class="px-4 py-1 rounded-full bg-green-500 text-white text-sm">Active</span>
                            @elseif($rom->status == 'selesai')
                                <span class="px-4 py-1 rounded-full bg-blue-500 text-white text-sm">Finished</span>
                            @else
                                <span class="px-4 py-1 rounded-full bg-red-500 text-white text-sm">Cancelled</span>
                            @endif
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold">Participants:</span>
                            <span class="flex items-center">
                                <i class="fas fa-users mr-2"></i>
                                {{ $rom->jumlah_peserta }}
                            </span>
                        </div>
                    </div>

                    @if(Auth::check())
                        @php
                            $isParticipant = $rom->users->contains(Auth::id());
                            $isOwner = Auth::id() === $rom->user_id;
                        @endphp

                        @if($isOwner)
                            <div class="flex gap-4 mt-6">
                                <a href="{{ route('roms.watching', $rom->id) }}" 
                                   class="flex-1 bg-indigo-600 text-white px-6 py-3 rounded-xl hover:bg-indigo-700 transition text-center font-semibold">
                                    Start Watching
                                </a>
                                <a href="{{ route('roms.edit', $rom->id) }}" 
                                   class="flex-1 bg-yellow-500 text-white px-6 py-3 rounded-xl hover:bg-yellow-600 transition text-center font-semibold">
                                    Edit Room
                                </a>
                            </div>
                        @elseif($isParticipant)
                            <div class="flex gap-4 mt-6">
                                <a href="{{ route('roms.watching', $rom->id) }}" 
                                   class="flex-1 bg-indigo-600 text-white px-6 py-3 rounded-xl hover:bg-indigo-700 transition text-center font-semibold">
                                    Start Watching
                                </a>
                                <form action="{{ route('roms.leave', $rom->id) }}" method="GET" class="flex-1">
                                    @csrf
                                    <button type="submit" 
                                            class="w-full bg-red-500 text-white px-6 py-3 rounded-xl hover:bg-red-600 transition text-center font-semibold">
                                        Leave Room
                                    </button>
                                </form>
                            </div>
                        @else
                            <form action="{{ route('roms.join', $rom->id) }}" method="POST" class="mt-6 space-y-4">
                                @csrf
                                <div>
                                    <label for="Key_rom" class="block text-white text-sm font-medium mb-2">Kunci Room</label>
                                    <input type="text" name="Key_rom" id="Key_rom" required
                                           class="w-full bg-white/10 border border-gray-300/30 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                           placeholder="Masukkan kunci room untuk bergabung">
                                    @error('Key_rom')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit"
                                        class="w-full bg-green-500 text-white px-6 py-3 rounded-xl hover:bg-green-600 transition text-center font-semibold">
                                    Bergabung ke Room
                                </button>
                            </form>
                        @endif
                    @else
                        <div class="mt-6 p-4 bg-white/10 rounded-xl text-center">
                            <p class="text-white">Please <a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 underline">login</a> to join this room.</p>
                        </div>
                    @endif
                </div>

                <!-- Chat Room Section -->
                <div class="bg-white/5 rounded-xl p-6">
                    <h3 class="text-xl font-bold text-white mb-4">Chat Room</h3>
                    <div class="space-y-4 max-h-[400px] overflow-y-auto mb-4">
                        @forelse ($comments as $comment)
                            <div class="bg-white/10 rounded-lg p-4">
                                <p class="text-gray-200">{{ $comment->content }}</p>
                            </div>
                        @empty
                            <p class="text-gray-400 text-center py-4">No comments yet. Be the first to comment!</p>
                        @endforelse
                    </div>

                    @if (Auth::check())
                        <form action="{{ route('roms.comments.create', $rom->id) }}" method="post" class="mt-4">
                            @csrf
                            <div class="mb-4">
                                <textarea 
                                    name="content" 
                                    placeholder="Write a comment..." 
                                    class="w-full bg-white/10 border border-gray-300/30 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" 
                                    rows="3" 
                                    required
                                ></textarea>
                            </div>
                            <button type="submit" 
                                    class="w-full bg-green-500 text-white px-6 py-3 rounded-xl hover:bg-green-600 transition font-semibold">
                                Submit Comment
                            </button>
                        </form>
                    @else
                        <div class="text-center bg-white/10 rounded-xl p-6">
                            <p class="text-gray-200">
                                Please <a href="{{ route('login2') }}" class="text-indigo-400 hover:text-indigo-300 underline">login</a> to join the discussion.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
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
@endsection
