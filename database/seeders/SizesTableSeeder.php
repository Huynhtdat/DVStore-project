<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = [
            ['name' => 'XXS'],
            ['name' => 'XS'],
            ['name' => 'S'],
            ['name' => 'M'],
            ['name' => 'L'],
            ['name' => 'XL'],
            ['name' => 'XXL'],
            ['name' => 'XXXL'],
            ['name' => 'XXXXL'],
            ['name' => '29'],
            ['name' => '30'],
            ['name' => '31'],
            ['name' => '32'],
            ['name' => '33'],
            ['name' => '34'],
            ['name' => '35'],
            ['name' => '36'],
            ['name' => '37'],
            ['name' => '38'],
            ['name' => '39'],
            ['name' => '40'],
            ['name' => '41'],
            ['name' => '42'],
            ['name' => '43'],
            ['name' => '44'],
            ['name' => 'FreeSize'],
        ];

        DB::table('sizes')->insert($sizes);
    }
}
