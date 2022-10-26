<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = [
            [
                'product_code' => Str::random(10),
                'product_name' => 'Sepatu Adidas',
                'price' => 500000,
                'currency' => 'IDR',
                'discount' => 10,
                'dimensions' => '40 cm x 15 cm',
                'unit' => 'PCS',
            ],
            [
                'product_code' => Str::random(10),
                'product_name' => 'Sepatu Nike',
                'price' => 400000,
                'currency' => 'IDR',
                'discount' => 20,
                'dimensions' => '40 cm x 15 cm',
                'unit' => 'PCS',
            ],
            [
                'product_code' => Str::random(10),
                'product_name' => 'Sepatu Puma',
                'price' => 600000,
                'currency' => 'IDR',
                'discount' => 10,
                'dimensions' => '40 cm x 15 cm',
                'unit' => 'PCS',
            ],
            [
                'product_code' => Str::random(10),
                'product_name' => 'Sepatu Compass',
                'price' => 600000,
                'currency' => 'IDR',
                'discount' => 10,
                'dimensions' => '40 cm x 15 cm',
                'unit' => 'PCS',
            ]
        ];

        Product::insert($product);
    }
}
