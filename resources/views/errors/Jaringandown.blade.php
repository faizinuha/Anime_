<!-- resources/views/errors/no_connection.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Periksa Koneksi Internet</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            color: #ff6347;
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        p {
            font-size: 1.2em;
            color: #333;
        }

        .container {
            text-align: center;
        }

        .anime-image {
            max-width: 200px;
            background: repeat;
            margin-bottom: 20px;
            background: transparent;
        }

        .retry-button {
          text-decoration:none; 
            background-color: blueviolet;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .retry-button:hover {
            background-color: green;
            filter: contrast(10);
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Tambahkan gambar anime dari internet -->
        <img src="{{ asset('Img1/png-clipart-female-anime-character-youtube-anime-female-shakugan-no-shana-youtube-face-black-hair-thumbnail.png') }}"
            alt="No Internet Anime" class="anime-image">
        <h1>Ups! Dunia Anime Terputus...</h1>
        <p>Sepertinya koneksi ke dunia anime telah terputus. Tanpa jaringan internet yang stabil, kita tidak bisa Nonton
            anime kesayanganmu.</p>
        <p>Pastikan jaringan internetmu tidak sedang diganggu oleh kekuatan jahat atau hacker dari dimensi lain!</p>
        <!-- Tombol untuk refresh halaman -->
        {{-- <button class="retry-button" onclick="relog()">Coba Sambungkan Kembali</button> --}}
        <a href="{{route('Anim')}}" class="retry-button" >Coba Sambungkan Kembali</a>
    </div>
    {{-- <script>
        // Fungsi untuk memberi umpan balik kepada pengguna
        function relog() {
            console.log('Mencoba menyambungkan kembali...');
            // Kamu bisa menambahkan logika tambahan di sini jika perlu
        }

        // Event listener global untuk memantau status online
        window.addEventListener('online', function() {
            console.log('Terhubung kembali!');
            window.location.href = '{{ url('/') }}'; // Arahkan pengguna ke halaman utama saat kembali online
        });
    </script> --}}
</body>

</html>
