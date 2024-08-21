<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AnimeSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Generate 10 dummy anime records
        foreach (range(1, 10) as $index) {
            DB::table('animes')->insert([
                'name' => $faker->word,
                'image' => $faker->imageUrl(),
                'video' => $faker->url,
                'category_id' => $faker->numberBetween(1, 5), // Adjust based on existing categories
                'release_date' => $faker->date,
                'description' => $faker->text,
                'status' => $faker->randomElement(['Ongoing', 'Completed', 'Upcoming']),
                'studio' => $faker->word,
                'episodes' => $faker->numberBetween(1, 50),
                'trailer' => $faker->url,
                'type' => $faker->randomElement(['TV', 'Movie', 'OVA', 'ONA', 'Special']),
                'duration' => $faker->numberBetween(20, 60),
                'synonyms' => $faker->word,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
