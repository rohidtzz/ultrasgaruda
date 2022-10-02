<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => "baju 1",
            'price' => 10000,
            'size' => "S,M,L,XL,XXL",
            'category_id' => 1
        ]);

        Product::create([
            'name' => "kertas 1",
            'price' => 100000,
            'size' => "S,M,L,XL,XXL",
            'category_id' => 1
        ]);

        Product::create([
            'name' => "baju 2",
            'price' => 20000,
            'size' => "S,M,L,XL,XXL",
            'category_id' => 2
        ]);

        Product::create([
            'name' => "kertas 2",
            'price' => 200000,
            'size' => "S,M,L,XL,XXL",
            'category_id' => 2
        ]);

        Product::create([
            'name' => "kertas 5",
            'price' => 200000,
            'size' => "S,M,L,XL,XXL",
            'category_id' => 2
        ]);

        Product::create([
            'name' => "kertas 8",
            'price' => 200000,
            'size' => "S,M,L,XL,XXL",
            'category_id' => 1
        ]);

    }
}
