@extends('layouts.nav12')

@section('content')
<style>
    * {
        scroll-behavior: smooth;
    }

    .anime-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 40px;
    }

    .anime-row {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        width: 100%;
        margin-bottom: 20px;
    }

    .anime-card {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        margin: 10px;
        padding: 15px;
        width: 250px;
        transition: transform 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .anime-card:hover {
        transform: translateY(-10px);
    }

    .anime-card img {
        width: 100%;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    .anime-card h2 {
        color: #50badd;
        font-size: 1.5em;
        margin-bottom: 10px;
        text-align: center;
    }

    .anime-card p {
        color: #fff;
        font-size: 1em;
        text-align: center;
        margin-bottom: 5px;
    }

    .anime-card .release-date {
        font-size: 0.9em;
        color: #ccc;
        text-align: center;
    }

    .underline {
        text-decoration: underline !important;
        color: #000;
    }
</style>

<div class="container mt-4">
    <h1 class="text-center underline" style="color: #50badd">Daftar Anime</h1>
    <div class="anime-container">
        <!-- Baris pertama (1–5) -->
        <div class="anime-row">
            @foreach ($animes->slice(0, 5) as $anime)
                <div class="anime-card">
                    <img src="{{ asset('storage/' . $anime->image) }}" alt="{{ $anime->name }}" class="img-fluid">
                    <div class="anime-details">
                        <h2>{{ $anime->name }}</h2>
                        <p class="text-center">{{ $anime->category->name }}</p>
                        <p class="release-date">Rilis: {{ \Carbon\Carbon::parse($anime->release_date)->format('d M Y') }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Baris kedua (6–10) -->
        <div class="anime-row">
            @foreach ($animes->slice(5, 5) as $anime)
                <div class="anime-card">
                    <img src="{{ asset('storage/' . $anime->image) }}" alt="{{ $anime->name }}" class="img-fluid">
                    <div class="anime-details">
                        <h2>{{ $anime->name }}</h2>
                        <p class="text-center">{{ $anime->category->name }}</p>
                        <p class="release-date">Rilis: {{ \Carbon\Carbon::parse($anime->release_date)->format('d M Y') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
