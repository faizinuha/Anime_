<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::table('users')->updateOrInsert(
            ['email' => 'rtxalham@gmail.com'], // Kondisi pencocokan
            [
                'name' => 'Zaki',
                'password' => Hash::make('as'),
                'role' => 'is_admin',
                // 'email_verified_at' => now(), // Menandai email sebagai verified
            ]
        );
        $this->call([
            CategorySeeder::class,
            // AnimeSeeder::class,
        ]);
    }
}
