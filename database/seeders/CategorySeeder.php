<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['category_name' => 'Fiksi'],
            ['category_name' => 'Non Fiksi'],
            ['category_name' => 'Baru'],
            ['category_name' => 'Bekas'],
        ]);
    }
}
