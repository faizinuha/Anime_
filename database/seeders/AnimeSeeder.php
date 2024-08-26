<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Anime;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AnimeSeeder extends Seeder
{
    public function run()
    {
        $animes = [
            [
                'name' => 'Naruto Shippuden',
                'image' => 'https://source.unsplash.com/random/800x600/category?anime,naruto',
                'video' => 'https://example.com/video/naruto_shippuden',
                'category_id' => 1,
                'release_date' => '2007-02-15',
                'description' => 'Sequel to Naruto, follows the journey of Naruto Uzumaki in his quest to become Hokage.',
                'status' => 'Completed',
                'studio' => 'Studio Pierrot',
                'episodes' => 500,
                'trailer' => 'https://example.com/trailer/naruto_shippuden',
                'type' => 'TV',
                'duration' => 23,
                'synonyms' => 'Naruto Hurricane Chronicles',
            ],
            // Tambahkan anime lain dengan struktur yang sama...
        ];

        foreach ($animes as $anime) {
            $imageContents = @file_get_contents($anime['image']);

            if ($imageContents === false) {
                // Fallback ke gambar default jika download gagal
                $imageContents = file_get_contents('https://via.placeholder.com/800x600?text=Anime');
            }

            $imageName = Str::random(10) . '.jpg';
            Storage::disk('public')->put('animes/' . $imageName, $imageContents);

            Anime::create([
                'name' => $anime['name'],
                'image' => 'animes/' . $imageName,
                'video' => $anime['video'],
                'category_id' => $anime['category_id'],
                'release_date' => $anime['release_date'],
                'description' => $anime['description'],
                'status' => $anime['status'],
                'studio' => $anime['studio'],
                'episodes' => $anime['episodes'],
                'trailer' => $anime['trailer'],
                'type' => $anime['type'],
                'duration' => $anime['duration'],
                'synonyms' => $anime['synonyms'],
            ]);
        }
    }
}
