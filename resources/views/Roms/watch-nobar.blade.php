@extends('layouts.app')

@section('content')
<div class="min-h-screen py-8">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Bagian Video Player -->
            <div class="lg:w-3/4">
                <div class="glass-effect rounded-2xl overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-4xl font-bold mb-6 text-white">{{ $rom->anime->title }}</h2>
                        
                        <div class="bg-black rounded-xl overflow-hidden mb-6 relative">
                            <video class="w-full aspect-video" 
                                   id="videoPlayer"
                                   controls 
                                   controlsList="nodownload" 
                                   poster="{{ asset('storage/' . $rom->anime->image) }}">
                                <source src="{{ asset('storage/' . $rom->anime->video) }}" type="video/mp4">
                                Browser Anda tidak mendukung pemutaran video.
                            </video>
                            <div class="absolute bottom-4 right-4 bg-black/50 px-3 py-1 rounded-lg">
                                <span class="text-white text-sm" id="currentTime">0:00</span>
                                <span class="text-white text-sm">/</span>
                                <span class="text-white text-sm" id="duration">0:00</span>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="p-4 glass-effect rounded-lg">
                                <h3 class="text-xl font-semibold text-white mb-2">Deskripsi</h3>
                                <p class="text-gray-200 leading-relaxed">{{ $rom->anime->description }}</p>
                            </div>
                            
                            <div class="flex justify-between items-center text-white">
                                <div class="flex items-center space-x-4">
                                    <span class="px-3 py-1 rounded-full text-sm 
                                        @if($rom->status == 'aktif') bg-green-500/50
                                        @elseif($rom->status == 'selesai') bg-blue-500/50
                                        @else bg-red-500/50
                                        @endif">
                                        {{ ucfirst($rom->status) }}
                                    </span>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg>
                                        <span>{{ $rom->jumlah_peserta }} Peserta</span>
                                    </div>
                                </div>
                                <span class="text-sm">{{ date('d M Y, H:i', strtotime($rom->tanggal_waktu)) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bagian Chat -->
            <div class="lg:w-1/4">
                <div class="glass-effect rounded-2xl h-[80vh] flex flex-col">
                    <div class="p-4 border-b border-white/10">
                        <h3 class="text-xl font-bold text-white">Obrolan Room</h3>
                    </div>
                    
                    <div class="flex-1 overflow-y-auto p-4 space-y-4" id="chatMessages">
                        <!-- Pesan chat akan ditambahkan secara dinamis di sini -->
                        <div class="flex flex-col space-y-1">
                            <div class="flex items-start space-x-2">
                                <div class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center flex-shrink-0">
                                    <span class="text-white text-sm font-bold">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</span>
                                </div>
                                <div class="bg-white/10 rounded-lg p-3 max-w-[80%]">
                                    <p class="text-sm font-semibold text-white">{{ Auth::user()->name ?? 'Anonim' }}</p>
                                    <p class="text-sm text-gray-200">Selamat datang di room chat!</p>
                                </div>
                            </div>
                            <span class="text-xs text-gray-400 ml-10">Baru saja</span>
                        </div>
                    </div>

                    <div class="p-4 border-t border-white/10">
                        <form id="chatForm" class="flex items-center space-x-2">
                            <input type="text" 
                                   class="flex-1 bg-white/10 border border-white/20 text-white rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                   placeholder="Ketik pesan..."
                                   id="messageInput">
                            <button type="submit" 
                                    class="bg-indigo-600 text-white p-2 rounded-lg hover:bg-indigo-700 transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-center mt-8">
            <a href="{{ route('roms.index') }}" 
               class="inline-flex items-center px-6 py-3 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Daftar Nobar
            </a>
        </div>
    </div>
</div>

<script>
    // Tampilan waktu video
    const video = document.getElementById('videoPlayer');
    const currentTimeDisplay = document.getElementById('currentTime');
    const durationDisplay = document.getElementById('duration');

    function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        seconds = Math.floor(seconds % 60);
        return `${minutes}:${seconds.toString().padStart(2, '0')}`;
    }

    video.addEventListener('loadedmetadata', () => {
        durationDisplay.textContent = formatTime(video.duration);
    });

    video.addEventListener('timeupdate', () => {
        currentTimeDisplay.textContent = formatTime(video.currentTime);
    });

    // Fungsi chat
    const chatForm = document.getElementById('chatForm');
    const chatMessages = document.getElementById('chatMessages');
    const messageInput = document.getElementById('messageInput');

    chatForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const message = messageInput.value.trim();
        if (!message) return;

        // Tambahkan pesan ke chat (ini hanya demo frontend - Anda perlu mengimplementasikan fungsi chat yang sebenarnya)
        const messageHTML = `
            <div class="flex flex-col space-y-1">
                <div class="flex items-start space-x-2">
                    <div class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center flex-shrink-0">
                        <span class="text-white text-sm font-bold">${'{{ substr(Auth::user()->name ?? "A", 0, 1) }}'}</span>
                    </div>
                    <div class="bg-white/10 rounded-lg p-3 max-w-[80%]">
                        <p class="text-sm font-semibold text-white">${'{{ Auth::user()->name ?? "Anonim" }}'}</p>
                        <p class="text-sm text-gray-200">${message}</p>
                    </div>
                </div>
                <span class="text-xs text-gray-400 ml-10">Baru saja</span>
            </div>
        `;
        
        chatMessages.insertAdjacentHTML('beforeend', messageHTML);
        chatMessages.scrollTop = chatMessages.scrollHeight;
        messageInput.value = '';
    });
</script>
@endsection
