<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand; // Ensure you import your Brand model

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create(['name' => 'Adidas']);
        Brand::create(['name' => 'Nike']);
        Brand::create(['name' => 'Gucci']);

        Brand::create(['name' => 'Zara']);
        Brand::create(['name' => 'H&M']);
        Brand::create(['name' => 'Uniqlo']);
        Brand::create(['name' => 'Routine']);
    }
}
