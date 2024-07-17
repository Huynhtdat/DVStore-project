<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productColors = [];

        for ($i = 1; $i <= 112; $i++) {
            $colorIds = range(1, 4);

            foreach ($colorIds as $colorId) {
                $productColors[] = [
                    'color_id' => $colorId,
                    'product_id' => $i,
                ];
            }
        }

        DB::table('products_color')->insert($productColors);
    }
}
