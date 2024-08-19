@extends('layouts.nav12')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Animes</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f4f8;
            color: #333;
        }

        .anime-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px; /* Jarak antar card */
            justify-content: center; /* Memusatkan card di tengah */
            margin-top: 40px;
        }

        .anime-card {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 15px;
            width: 250px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .anime-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .anime-card img {
            width: 100%;
            height: 200px; /* Sesuaikan dengan kebutuhan */
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .anime-card h5, .anime-card h6 {
            color: #50badd;
            font-size: 1.1em;
            margin-bottom: 10px;
        }

        .anime-card p {
            color: #555;
            font-size: 1em;
            margin-bottom: 10px;
        }

        .anime-card .release-date {
            font-size: 0.9em;
            color: #888;
        }

        .underline {
            text-decoration: underline;
            color: #50badd;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center underline">Hasil</h1>
        <div class="anime-list">
            @if ($results->isEmpty())
                <p class="text-center text-gray-600 col-span-full">No results found.</p>
            @else
                @foreach ($results as $result)
                    <div class="anime-card">
                        @if ($result->image)
                            <img src="{{ asset('storage/' . $result->image) }}" alt="{{ $result->name }}">
                        @else
                            <img src="https://via.placeholder.com/500x200?text=No+Image" alt="No image available">
                        @endif
                        <div class="card-body">
                            <h5>Name: {{ $result->name }}</h5>
                            <h6>Type: {{ $result->type }}</h6>
                            <h6>Durasi: {{ $result->duration }}</h6>
                            <p>Deskripsi: {{ $result->description }}</p>
                            <h6 class="release-date">Rilis: {{ $result->release_date }}</h6>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>
@endsection
