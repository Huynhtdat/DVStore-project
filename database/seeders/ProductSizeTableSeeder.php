<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSizeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        for ($colorId = 1; $colorId <= 576; $colorId++) {
            for ($sizeId = 3; $sizeId <= 6; $sizeId++) {
                $quantity = 10;

                $data[] = [
                    'product_color_id' => $colorId,
                    'size_id' => $sizeId,
                    'quantity' => $quantity,
                ];
            }
        }

        // Insert all data at once
        DB::table('products_size')->insert($data);
    }
}
