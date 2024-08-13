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
            ['email' => 'midas@gmail.com'], // Kondisi pencocokan
            [
                'name' => 'muhammad idris',
                'password' => Hash::make('12345678'),
                'role' => 'is_member',
                'email_verified_at' => now(), // Menandai email sebagai verified
            ]
        );
        
        DB::table('users')->updateOrInsert(
            ['email' => 'safei@gmail.com'],
            [
                'name' => 'safei',
                'password' => Hash::make('12345678'),
                'role' => 'is_member',
                'email_verified_at' => now(), // Menandai email sebagai verified
            ]
        );
        
        DB::table('users')->updateOrInsert(
            ['email' => 'idris@gmail.com'],
            [
                'name' => 'idris',
                'password' => Hash::make('12345678'),
                'role' => 'is_guest',
                'email_verified_at' => now(), // Menandai email sebagai verified
            ]
        );
        DB::table('users')->updateOrInsert(
            ['email' => 'rtxalham@gmail.com'], // Kondisi pencocokan
            [
                'name' => 'Zaki',
                'password' => Hash::make('12345678'),
                'role' => 'is_admin',
                'email_verified_at' => now(), // Menandai email sebagai verified
            ]
        );
        $this->call([
            CategorySeeder::class,
            // AnimeSeeder::class,
        ]);
    }
}
