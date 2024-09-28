<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Anime;
use Illuminate\Support\Facades\Storage;

class UpdateAnimeFromAniList extends Command
{
    protected $signature = 'anime:update-from-anilist';
    protected $description = 'Update anime data from AniList API';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $query = <<<'GRAPHQL'
        query ($page: Int, $perPage: Int) {
            Page(page: $page, perPage: $perPage) {
                media(type: ANIME, sort: POPULARITY_DESC) {
                    id
                    title {
                        romaji
                        english
                    }
                    coverImage {
                        large
                    }
                    description
                    startDate {
                        year
                        month
                        day
                    }
                    episodes
                    duration
                    studios {
                        nodes {
                            name
                        }
                    }
                    genres
                    format
                    status
                }
            }
        }
        GRAPHQL;

        // Send GraphQL query
        $response = Http::post('https://graphql.anilist.co', [
            'query' => $query,
            'variables' => [
                'page' => 1,
                'perPage' => 10,
            ],
        ]);

        // Validate the response
        if ($response->failed()) {
            $this->error('Failed to fetch data from AniList API.');
            return;
        }

        $data = $response->json()['data']['Page']['media'] ?? [];

        foreach ($data as $animeData) {
            $existingAnime = Anime::where('name', $animeData['title']['romaji'])->first();

            if (!$existingAnime) {
                $anime = new Anime();
                $anime->name = $animeData['title']['romaji'] ?? 'Unknown Title';

                // Handle image download
                $imageUrl = $animeData['coverImage']['large'] ?? null;

                if ($imageUrl) {
                    $imageResponse = Http::get($imageUrl);

                    if ($imageResponse->successful()) {
                        $imageContents = $imageResponse->body();
                        $imageExtension = $this->getImageExtension($imageResponse);
                        $imageName = 'anime_' . $animeData['id'] . '.' . $imageExtension;

                        // Save image to storage
                        Storage::put('public/images/' . $imageName, $imageContents);
                        $anime->image = 'images/' . $imageName; // Path yang disimpan di database

                    } else {
                        $this->error("Failed to fetch image for anime: " . $animeData['title']['romaji']);
                        $anime->image = null;
                    }
                } else {
                    $anime->image = null;
                }

                // Other fields
                $anime->description = isset($animeData['description']) ? strip_tags($animeData['description']) : 'No description available';
                $anime->release_date = $this->formatDate($animeData['startDate'] ?? null);
                $anime->episodes = $animeData['episodes'] ?? 0;
                $anime->duration = $animeData['duration'] ?? 0;
                $anime->studio = $animeData['studios']['nodes'][0]['name'] ?? 'Unknown Studio';
                $anime->type = $animeData['format'] ?? 'Unknown';
                $anime->status = $animeData['status'] ?? 'Unknown';

                try {
                    $anime->save();
                    $this->info("Added new anime: " . $animeData['title']['romaji']);
                } catch (\Exception $e) {
                    $this->error("Failed to save anime: " . $animeData['title']['romaji'] . ". Error: " . $e->getMessage());
                }
            } else {
                $this->info("Anime already exists: " . $animeData['title']['romaji']);
            }
        }
    }

    // Helper function to determine image extension
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

    // Helper function to format the date
    private function formatDate($startDate)
    {
        if (isset($startDate['year'])) {
            $year = $startDate['year'];
            $month = isset($startDate['month']) ? str_pad($startDate['month'], 2, '0', STR_PAD_LEFT) : '01';
            $day = isset($startDate['day']) ? str_pad($startDate['day'], 2, '0', STR_PAD_LEFT) : '01';
            return "$year-$month-$day";
        }

        return null;
    }
}
