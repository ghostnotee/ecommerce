<?php

use App\Models\Product;
use App\Models\ProductDetails;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
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
    public function run(Generator $faker)
    {
        Schema::disableForeignKeyConstraints();

        Product::truncate();
        ProductDetails::truncate();

        for ($i = 0; $i < 30; $i++) {
            $productName = $faker->sentence(2);
            $product = Product::create([
                'product_name' => $productName,
                'slug' => str::slug($productName),
                'description' => $faker->sentence(20),
                'price' => $faker->randomfloat(3, 1, 20)
            ]);
            $details = $product->details()->create([
                'show_slider' => rand(0, 1),
                'show_opportunity_of_the_day' => rand(0, 1),
                'show_featured' => rand(0, 1),
                'show_most_selling' => rand(0, 1),
                'show_damp' => rand(0, 1)
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
