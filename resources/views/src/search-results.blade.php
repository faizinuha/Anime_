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
            background-color: #ffffff; /* Latar belakang putih lembut */
            border-radius: 10px;
            padding: 10px;
            display: flex;
            width: 400;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Bayangan lembut */
        }

        .anime-card:hover {
            transform: translateY(-5px); /* Sedikit hover effect */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .anime-card img {
            width: 100%;
            height: 200px; /* Sesuaikan dengan kebutuhan */
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .anime-card h5, .anime-card h6 {
            color: #4a90e2; /* Warna teks lembut */
            font-size: 1.1em;
            margin-bottom: 10px;
        }

        .anime-card p {
            color: #666; /* Warna teks paragraf yang lebih lembut */
            font-size: 1em;
            margin-bottom: 10px;
        }

        .anime-card .release-date {
            font-size: 0.9em;
            color: #888; /* Warna teks lebih redup */
        }

        /* .underline {
            text-decoration: underline;
            color: #4a90e2; /* Warna teks lembut */
        } */
        .typing-effect {
            font-size: 2em;
            color: #333;
            border-right: 2px solid #333;
            white-space: nowrap;
            overflow: hidden;
            width: 0;
            animation: typing 5s steps(40, end), blink-caret 0.75s step-end infinite;
        }

        @keyframes typing {
            from { width: 0; }
            to { width: 100%; }
        }

        @keyframes blink-caret {
            from, to { border-color: transparent; }
            50% { border-color: #333; }
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="typing-effect">->!</div>
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
   
    <script>
        const textElement = document.querySelector('.typing-effect');
        const textArray = ["Ini Adalah hasil Pencarian anda!", "Bantu Terus dengan Donate Di Bawah!", "Enjoy Ke AniHub!"];
        let textIndex = 0;
        let charIndex = 0;

        function typeText() {
            if (charIndex < textArray[textIndex].length) {
                textElement.innerHTML += textArray[textIndex].charAt(charIndex);
                charIndex++;
                setTimeout(typeText, 100); // Adjust typing speed here
            } else {
                setTimeout(() => {
                    deleteText();
                }, 2000); // Pause before starting to delete text
            }
        }

        function deleteText() {
            if (charIndex > 0) {
                textElement.innerHTML = textArray[textIndex].substring(0, charIndex - 1);
                charIndex--;
                setTimeout(deleteText, 50); // Adjust deletion speed here
            } else {
                textIndex = (textIndex + 1) % textArray.length;
                setTimeout(typeText, 200); // Pause before starting to type next text
            }
        }

        typeText(); // Start the typing effect loop
    </script>
</body>


</html>
@endsection
