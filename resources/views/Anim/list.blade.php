@extends('layouts.nav12')

@section('content')
<style>
    /* Style untuk container utama */   
    *{
        scroll-behavior: smooth;
    }
    .anime-list {
        display: flex; 
        flex-wrap: wrap;
        justify-content: start;
        margin-top: 40px;
    }

    /* Style untuk setiap card anime */
    .anime-card {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        margin: 20px;
        padding: 15px;
        width: 250px;
        transition: transform 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    /* Animasi hover untuk card */
    .anime-card:hover {
        transform: translateY(-10px);
    }

    /* Style untuk gambar anime di dalam card */
    .anime-card img {
        width: 100%;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    /* Style untuk judul anime */
    .anime-card h2 {
        color: #50badd;
        font-size: 1.5em;
        margin-bottom: 10px;
        text-align: center;
    }

    /* Style untuk kategori anime */
    .anime-card p {
        color: #fff;
        font-size: 1em;
        text-align: center;
        margin-bottom: 5px;
    }

    /* Style untuk tanggal rilis */
    .anime-card .release-date {
        font-size: 0.9em;
        color: #ccc;
        text-align: center;
    }
    .underline{
        text-decoration: underline !important;
        color: #000;
    }
</style>

<div class="container mt-4">
    <h1 class="text-center underline" style="color: #50badd">Daftar Anime</h1>
    <div class="anime-list">
        @foreach ($animes as $anime)
            <div class="anime-card">
                <img src="{{ asset('storage/' . $anime->image) }}" alt="{{ $anime->name }}" class="img-fluid">
                <div class="anime-details">
                    <h2>{{ $anime->name }}</h2>
                    <p class="text-center">{{ $anime->category->name }}</p>
                    <p class="release-date">Rilis: {{ \Carbon\Carbon::parse($anime->release_date)->format('d M Y') }}</p>
                    {{-- <a href="{{ route('Anim.show', $anime->id) }}" class="btn btn-primary">Lihat Detail</a> --}}
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
