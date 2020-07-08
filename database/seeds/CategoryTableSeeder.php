<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('categories')->truncate();

        $upId = DB::table('categories')->insertGetId(['category_name' => 'Elektronik', 'slug' => 'elektronik']);
        DB::table('categories')->insert(['category_name'=>'Bilgisayar/Tablet','slug'=>'bilgisayar-tablet','up_id'=>$upId]);
        DB::table('categories')->insert(['category_name'=>'Telefon','slug'=>'telefon','up_id'=>$upId]);
        DB::table('categories')->insert(['category_name'=>'Tv ve Ses Sistemleri','slug'=>'tv-ses-sistemleri','up_id'=>$upId]);
        DB::table('categories')->insert(['category_name'=>'Kamera','slug'=>'kamera','up_id'=>$upId]);

        $upId = DB::table('categories')->insertGetId(['category_name' => 'Kitap', 'slug' => 'kitap']);
        DB::table('categories')->insert(['category_name'=>'Edebiyat','slug'=>'edebiyat','up_id'=>$upId]);
        DB::table('categories')->insert(['category_name'=>'Çocuk','slug'=>'cocuk','up_id'=>$upId]);
        DB::table('categories')->insert(['category_name'=>'Bilgisayar','slug'=>'bilgisayar','up_id'=>$upId]);
        DB::table('categories')->insert(['category_name'=>'Sınavlara Hazırlık','slug'=>'sinavlara-hazirlik','up_id'=>$upId]);

        DB::table('categories')->insert(['category_name' => 'Dergi', 'slug' => 'dergi']);
        DB::table('categories')->insert(['category_name' => 'Mobilya', 'slug' => 'mobilya']);
        DB::table('categories')->insert(['category_name' => 'Dekorasyon', 'slug' => 'dekorasyon']);
        DB::table('categories')->insert(['category_name' => 'Kozmetik', 'slug' => 'kozmetik']);
        DB::table('categories')->insert(['category_name' => 'Kişisel Bakım', 'slug' => 'kisisel-bakım']);
        DB::table('categories')->insert(['category_name' => 'Giyim ve Moda', 'slug' => 'giyim-moda']);
        DB::table('categories')->insert(['category_name' => 'Anne ve Çocuk', 'slug' => 'anne-cocuk']);

        Schema::enableForeignKeyConstraints();
    }
}
