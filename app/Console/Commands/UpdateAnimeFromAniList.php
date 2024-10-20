<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Anime;
use Illuminate\Support\Facades\Storage;

class UpdateAnimeFromAniList extends Command
{
    protected $signature = 'anime:update {--random}';
    protected $description = 'Perbarui data anime dari API Jikan';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        if ($this->option('random')) {
            $this->getRandomAnime();
            return;
        }

        // API Jikan for popular anime list
        $this->updatePopularAnimes();
    }

    private function updatePopularAnimes()
    {
        $response = Http::get('https://api.jikan.moe/v4/top/anime', ['page' => 5]);

        if ($response->failed()) {
            $this->error('Gagal mengambil data dari API Jikan.');
            return;
        }

        $data = $response->json()['data'] ?? [];

        foreach ($data as $animeData) {
            $this->processAnimeData($animeData);
        }
    }

    private function processAnimeData($animeData)
    {
        $existingAnime = Anime::where('name', $animeData['title'])->first();

        if (!$existingAnime) {
            $anime = new Anime();
            $anime->name = $animeData['title'] ?? 'Judul Tidak Dikenal';

            // Handle image download
            $anime->image = $this->downloadImage($animeData['images']['jpg']['image_url'] ?? null, $animeData['mal_id']);

            // Other fields
            $anime->description = $animeData['synopsis'] ?? 'Tidak ada deskripsi tersedia';
            $anime->release_date = $animeData['aired']['from'] ?? null;
            $anime->episodes = $animeData['episodes'] ?? 0;
            $anime->studio = $animeData['studios'][0]['name'] ?? 'Studio Tidak Dikenal';
            $anime->type = $animeData['type'] ?? 'Tidak Dikenal';
            $anime->status = $animeData['status'] ?? 'Tidak Dikenal';
            // Tambahkan ini di prosesAnimeData
            $anime->trailer = $animeData['trailer']['embed_url'] ?? null; // Set trailer jika ada


            // Menyimpan sinonim dan total episode
            $synonyms = array_column($animeData['titles'] ?? [], 'title'); // Ambil title dari titles array
            $anime->synonyms = implode(', ', $synonyms); // Gabungkan sinonim menjadi string
            $anime->TotalEps = $animeData['episodes'] ?? 0; // Menyimpan total episode (gunakan episodes yang sudah ada)

            try {
                $anime->save();
                $this->info("Menambahkan anime baru: " . $animeData['title'] . ", Sinonim: " . $anime->synonyms . ", Total Episode: " . $anime->TotalEps);
            } catch (\Exception $e) {
                $this->error("Gagal menyimpan anime: " . $animeData['title'] . ". Kesalahan: " . $e->getMessage());
            }
        } else {
            $this->info("Anime sudah ada: " . $animeData['title']);
        }
    }


    private function getRandomAnime()
    {
        $response = Http::get('https://api.jikan.moe/v4/random/anime');

        if ($response->failed()) {
            $this->error('Gagal mengambil data anime acak dari API.');
            return;
        }

        $animeData = $response->json()['data'] ?? null;

        if ($animeData) {
            $this->processAnimeData($animeData);
        } else {
            $this->error('Tidak ada data anime yang ditemukan.');
        }
    }

    private function downloadImage($imageUrl, $malId)
    {
        if (!$imageUrl) {
            return null;
        }

        $imageResponse = Http::get($imageUrl);

        if ($imageResponse->successful()) {
            $imageContents = $imageResponse->body();
            $imageExtension = $this->getImageExtension($imageResponse);
            $imageName = 'anime_' . $malId . '.' . $imageExtension;

            // Save image to storage
            Storage::put('public/images/' . $imageName, $imageContents);
            return 'images/' . $imageName; // Path stored in the database
        }

        $this->error("Gagal mengambil gambar untuk anime dengan ID: " . $malId);
        return null;
    }

    private function getImageExtension($response)
    {
        $mimeType = $response->header('Content-Type');

        if (str_contains($mimeType, 'jpeg')) {
            return 'jpg';
        } elseif (str_contains($mimeType, 'png')) {
            return 'png';
        }

        return 'jpg'; // Default to jpg if mime type is unclear
    }
    }
                