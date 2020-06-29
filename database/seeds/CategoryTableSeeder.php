<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();
        DB::table('categories')->insert(['category_name' => 'Elektronik', 'slug' => 'elektronik']);
        DB::table('categories')->insert(['category_name' => 'Kitap', 'slug' => 'kitap']);
        DB::table('categories')->insert(['category_name' => 'Dergi', 'slug' => 'dergi']);
        DB::table('categories')->insert(['category_name' => 'Mobilya', 'slug' => 'mobilya']);
        DB::table('categories')->insert(['category_name' => 'Dekorasyon', 'slug' => 'dekorasyon']);
        DB::table('categories')->insert(['category_name' => 'Kozmetik', 'slug' => 'kozmetik']);
        DB::table('categories')->insert(['category_name' => 'Kişisel Bakım', 'slug' => 'kisisel-bakım']);
        DB::table('categories')->insert(['category_name' => 'Giyim ve Moda', 'slug' => 'giyim-moda']);
        DB::table('categories')->insert(['category_name' => 'Anne ve Çocuk', 'slug' => 'anne-cocuk']);
    }
}
