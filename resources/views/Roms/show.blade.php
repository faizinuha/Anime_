@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<div class="container mt-5">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        
        <!-- Anime Thumbnail Section -->
        <div class="position-relative">
            @if(isset($rom->anime))
                <img src="{{ asset('storage/' . $rom->anime->image) }}" alt="Anime Thumbnail" class="w-100 h-64 object-cover">
                <div class="position-absolute top-0 left-0 bg-black bg-opacity-75 text-white p-4 rounded-bottom">
                    <h1 class="display-6 font-weight-bold">{{ $rom->anime->name }}</h1>
                    <p class="h5">{{ date('F j, Y, g:i A', strtotime($rom->tanggal_waktu)) }}</p>
                </div>
            @else
                <p class="text-center text-muted p-4">Anime data is not available for this room.</p>
            @endif
        </div>

        <!-- Room Information Section -->
        <div class="p-5">
            <h2 class="h3 font-weight-semibold border-bottom pb-3 mb-4">Room Information</h2>
            <p class="text-muted mb-4">{{ $rom->deskripsi ?? 'No description available.' }}</p>

            <div class="d-flex justify-content-between mb-4">
                <div class="text-secondary">
                    <p><strong>Nama Ketua:</strong> {{ $rom->ketua->name }}</p>
                    <p><strong>Status:</strong> 
                        @if($rom->status == 'aktif')
                            <span class="badge bg-success">Active</span>
                        @elseif($rom->status == 'selesai')
                            <span class="badge bg-primary">Finished</span>
                        @else
                            <span class="badge bg-danger">Cancelled</span>
                        @endif
                    </p>
                    <p><strong>Participants:</strong> {{ $rom->jumlah_peserta }}</p>
                </div>
            </div>

            <!-- Mulai Button for Room Host -->
            @if (Auth::check() && Auth::user()->id === $rom->user_id)
                <a href="{{ route('roms.watching', $rom->id) }}" class="btn btn-primary">Mulai</a>
            @endif
        </div>

        <!-- Chat Room Section -->
        <div class="bg-light p-4 rounded-lg mx-5 mt-4 mb-5">
            <h3 class="h4 font-weight-semibold mb-3">Chat Room</h3>
            
            @forelse ($comments as $comment)
                <p class="text-secondary">Pesan: {{ $comment->content }}</p>
            @empty
                <p class="text-secondary">No comments yet.</p>
            @endforelse
        
            <!-- Comment Form -->
            @if (Auth::check())
                <form action="{{ route('comment.store') }}" method="post" class="mt-3">
                    @csrf
                    <input type="hidden" namwebe="anime_id" value="{{ $rom->anime->id }}">
                    <div class="form-group mb-3">
                        <textarea name="content" placeholder="Write a comment..." class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            @else
                <p class="text-muted mt-3">Please <a href="{{ route('login2') }}" class="text-primary">login</a> to comment.</p>
            @endif
        </div>
        
    </div>
</div>
@endsection
