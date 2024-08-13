@extends('layouts.nav12')

@section('content')
    <div class="container mt-4">
        <h1>Daftar Anime</h1>
        <div class="anime-list">
            @foreach ($animes as $anime)
                <div class="anime-card">
                    <img src="{{ asset('storage/' . $anime->image) }}" alt="{{ $anime->name }}" class="img-fluid">
                    <div class="anime-details">
                        <h2>{{ $anime->name }}</h2>
                        <p>{{ $anime->description }}</p>
                        <a href="{{ route('anime.show', $anime->id) }}" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
