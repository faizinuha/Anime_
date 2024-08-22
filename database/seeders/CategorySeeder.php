<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**   
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Action'],
            ['name' => 'Adventure'],
            ['name' => 'Comedy'],
            ['name' => 'Drama'],
            ['name' => 'Fantasy'],
            ['name' => 'Horror'],
            ['name' => 'Mystery'],
            ['name' => 'Romance'],
            ['name' => 'Sci-Fi'],
            ['name' => 'Slice of Life'],
            ['name' => 'Supernatural'],
            ['name' => 'Thriller'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
