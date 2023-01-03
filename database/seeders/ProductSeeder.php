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
            'name' => "tiket stadion",
            'price' => 100000,
            'size' => "S,M,L,XL,XXL",
            'category_id' => 1,
            'image' => 'lo.jpg',
            'stock' => 200,
            'desc' => 'tiket ug paling keren'
        ]);

        // Product::create([
        //     'name' => "Baju Ultras",
        //     'price' => 110000,
        //     'size' => "S,M,L,XL,XXL",
        //     'category_id' => 1,
        //     'image' => '2.jpg',
        //     'stock' => 100
        // ]);

        // Product::create([
        //     'name' => "Baju Ngaji",
        //     'price' => 120000,
        //     'size' => "S,M,L,XL,XXL",
        //     'category_id' => 2,
        //     'image' => '3.jpg',
        //     'stock' => 100
        // ]);

        // Product::create([
        //     'name' => "Baju Tidur",
        //     'price' => 130000,
        //     'size' => "S,M,L,XL,XXL",
        //     'category_id' => 2,
        //     'image' => '4.jpg',
        //     'stock' => 100
        // ]);

        // Product::create([
        //     'name' => "Bikini",
        //     'price' => 140000,
        //     'size' => "S,M,L,XL,XXL",
        //     'category_id' => 2,
        //     'image' => '5.jpg',
        //     'stock' => 100
        // ]);

        // Product::create([
        //     'name' => "Rok",
        //     'price' => 150000,
        //     'size' => "S,M,L,XL,XXL",
        //     'category_id' => 1,
        //     'image' => '6.jpg',
        //     'stock' => 100
        // ]);

    }
}
