<?php

namespace Database\Seeders;
use App\Models\Product;

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name'=> 'Apple Watch 7', 
                'price' => '999.99',
                'is_active' => 1,
                'user_id' => 1
            ],
            [
                'name'=> 'Apple Macbook Pro 14',
                'price' => '1299.99',
                'is_active' => 1,
                'user_id' => 1
            ],
            [
                'name'=> 'Apple Macbook Pro 16',
                'price' => '1299.99',
                'is_active' => 1,
                'user_id' => 2
            ],
            [
                'name'=> 'Samsung Galaxy Book 2',
                'price' => '1199.99',
                'is_active' => 1,
                'user_id' => 2
            ],
            [
                'name'=> 'Iphone 13 Pro max',
                'price' => '699.99',
                'is_active' => 1,
                'user_id' => 3
            ],
            [
                'name'=> 'JBL Charge 3+',
                'price' => '300',
                'is_active' => 1,
                'user_id' => 4
            ]
            
        ];
        
        foreach ($products as $key => $value) {
            Product::create($value);
        }
    }
}
