<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            ['name' => 'Red'],
            ['name' => 'Blue'],
            ['name' => 'Green'],
            ['name' => 'Yellow'],
            ['name' => 'Black'],
            ['name' => 'White'],
            ['name' => 'Purple'],
            ['name' => 'Orange'],
            ['name' => 'Pink'],
            ['name' => 'Brown'],
            ['name' => 'Grey'],
            ['name' => 'Beige'],
            ['name' => 'Navy'],
            ['name' => 'Teal'],
            ['name' => 'Maroon'],
            ['name' => 'Olive'],
            ['name' => 'Coral'],
            ['name' => 'Magenta'],
            ['name' => 'Turquoise'],
            ['name' => 'Lavender'],
            ['name' => 'Mustard'],
            ['name' => 'Charcoal'],
            ['name' => 'Khaki'],
            ['name' => 'Indigo'],
            ['name' => 'Aqua'],
            ['name' => 'Slate'],
            ['name' => 'Taupe'],
            ['name' => 'Bright'],
            ['name' => 'Cyan'],
            ['name' => 'Lime'],
            ['name' => 'Crimson'],
            ['name' => 'Gold'],
            ['name' => 'Silver'],
            ['name' => 'Ivory'],
            ['name' => 'Mint'],
            ['name' => 'Peach'],
            ['name' => 'Plum'],
            ['name' => 'Amber'],
            ['name' => 'Azure'],
            ['name' => 'Ruby'],
            ['name' => 'Sapphire'],
            ['name' => 'Emerald'],
            ['name' => 'Violet'],
            ['name' => 'Fuchsia'],
            ['name' => 'Periwinkle'],
            ['name' => 'Burgundy'],
            ['name' => 'Mauve'],
            ['name' => 'Rose'],
            ['name' => 'Jade'],
            ['name' => 'Sienna'],
            ['name' => 'Sand'],
            ['name' => 'Cobalt'],
            ['name' => 'Bronze'],
            ['name' => 'Copper'],
            ['name' => 'Apricot'],
            ['name' => 'Wheat'],
            ['name' => 'Sky'],
            ['name' => 'Cerulean'],
            ['name' => 'Blush'],
            ['name' => 'Cinnamon'],
            ['name' => 'Eggplant'],
            ['name' => 'Lilac'],
            ['name' => 'Rust'],
            ['name' => 'Mint Green'],
            ['name' => 'Seafoam'],
            ['name' => 'Slate Blue'],
            ['name' => 'Orchid'],
        ];

        DB::table('colors')->insert($colors);
    }
}
