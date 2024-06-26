<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriesTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ProductImagesTableSeeder::class);
        $this->call(SizesTableSeeder::class);
        $this->call(ColorsTableSeeder::class);
        $this->call(ProductsColorTableSeeder::class);
        $this->call(ProductSizeTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
    }
}
