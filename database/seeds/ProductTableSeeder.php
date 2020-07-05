<?php

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param $faker
     * @return void
     */
    public function run($faker)
    {
        Product::truncate();

        for ($i = 0; $i < 30; $i++) {
            $productName = $faker->sentence(2);
            Product::create([
                'product_name' => $productName,
                'slug' => str::slug($productName),
                'description' => $faker->sentence(20),
                'price' => $faker->randomfloat(3, 1, 20)]);
        }
    }
}
