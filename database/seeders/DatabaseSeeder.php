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
        DB::table('users')->insert([
            [
                'name' => 'muhammad idris',
                'email' => 'midas@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'is_admin'
            ],
            [
                'name' => 'safei',
                'email' => 'safei@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'is_member'
            ],
            [
                'name' => 'idris',
                'email' => 'idris@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'is_guest'
            ]
        ]);

        $this->call([
            CategorySeeder::class,
            // AnimeSeeder::class,
        ]);
    }
}
