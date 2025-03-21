<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductExtrasSeeder extends Seeder
{
    public function run(): void
    {

        // Basic offers list
        $extras = [
            [
                'name' => 'Government fees',
                'price' => 55,
                'description' => '',
                'type' => 'gov_fees',
                'required' => true,
                'metas' => [
                    //['key' => 'duration', 'value' => '2 days'],
                    //['key' => 'duration_hours', 'value' => 72],
                ],
            ],
            [
                'name' => 'Denial protection',
                'price' => 25,
                'description' => '',
                'type' => '',
                'required' => false,
                'metas' => [
                    //['key' => 'duration', 'value' => '2 days'],
                    //['key' => 'duration_hours', 'value' => 72],
                ],
            ],
        ];

        // Take all products
        $products = Product::all();

        // Loop through all products
        foreach ($products as $product) {

            // Assign metas to the offers
            foreach ($extras as $extra) {
                $product->extras()->firstOrCreate([
                    'name' => $extra['name'],
                    'product_id' => $product->id,
                ],
                [
                    'name' => $extra['name'],
                    'price' => $extra['price'],
                    'description' => $extra['description'],
                    'type' => $extra['type'],
                    'required' => $extra['required'],
                ])->meta()->createMany($extra['metas']);
            }

        }


    }
}
