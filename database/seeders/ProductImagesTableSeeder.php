<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductImage;

class ProductImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            1 => [
                'polo-1-1.jpg',
                'polo-1-2.jpg',
                'polo-1-3.jpg',
                'polo-1-4.jpg'
            ],
            2 => [
                'ao-polo-2-2.jpg',
                'ao-polo-2-3.jpg',
                'ao-polo-2-4.jpg',
                'ao-polo-2-5.jpg'
            ],
            3 => [
                'ao-polo-nam-3-2.jpg',
                'ao-polo-nam-3-3.jpg',
                'ao-polo-nam-3-4.jpg',
                'ao-polo-nam-3-5.jpg'
            ],
            4 => [
                'ao-polo-nam-4-2.jpg',
                'ao-polo-nam-4-3.jpg',
                'ao-polo-nam-4-4.jpg'
            ],
            5 => [
                'ao-polo-nam-5-2.jpg',
                'ao-polo-nam-5-3.jpg',
                'ao-polo-nam-5-4.jpg',
                'ao-polo-nam-5-5.jpg',
                'ao-polo-nam-5-6.jpg',
            ],
            6 => [
                'ao-polo-nam-6-2.jpg',
                'ao-polo-nam-6-3.jpg',
                'ao-polo-nam-6-4.jpg',
                'ao-polo-nam-6-5.jpg',
            ],
            7 => [
                'ao-thun-1-2.jpg',
                'ao-thun-1-3.jpg',
                'ao-thun-1-4.jpg',
                'ao-thun-1-5.jpg',
                'ao-thun-1-6.jpg',
            ],
            8 => [
                'ao-thun-2-2.jpg',
                'ao-thun-2-3.jpg',
                'ao-thun-2-4.jpg',
                'ao-thun-2-5.jpg',
                'ao-thun-2-6.jpg',
            ],
            9 => [
                'ao-thun-3-2.jpg',
                'ao-thun-3-3.jpg',
                'ao-thun-3-4.jpg',
                'ao-thun-3-5.jpg',
            ],
            10 => [
                'ao-thun-4-2.jpg',
                'ao-thun-4-3.jpg',
                'ao-thun-4-4.jpg',
                'ao-thun-4-5.jpg',
                'ao-thun-4-6.jpg',
            ],
            11 => [
                'ao-thun-5-2.jpg',
                'ao-thun-5-3.jpg',
                'ao-thun-5-4.jpg',
                'ao-thun-5-5.jpg',
            ],
            12 => [
                'ao-thun-6-2.jpg',
                'ao-thun-6-3.jpg',
                'ao-thun-6-4.jpg',
            ],
            13 => [
                'ao-so-mi-1-2.jpg',
                'ao-so-mi-1-3.jpg',
                'ao-so-mi-1-4.jpg',
                'ao-so-mi-1-5.jpg',
                'ao-so-mi-1-6.jpg',
            ],
            14 => [
                'ao-so-mi-2-2.jpg',
                'ao-so-mi-2-3.jpg',
                'ao-so-mi-2-4.jpg',
                'ao-so-mi-2-5.jpg',
            ],
            15 => [
                'ao-so-mi-3-2.jpg',
                'ao-so-mi-3-3.jpg',
                'ao-so-mi-3-4.jpg',
                'ao-so-mi-3-5.jpg',
            ],
            16 => [
                'ao-so-mi-4-2.jpg',
                'ao-so-mi-4-3.jpg',
                'ao-so-mi-4-4.jpg',
                'ao-so-mi-4-5.jpg',
            ],
            17 => [
                'ao-so-mi-5-2.jpg',
                'ao-so-mi-5-3.jpg',
                'ao-so-mi-5-4.jpg',
                'ao-so-mi-5-5.jpg',
            ],
            18 => [
                'ao-so-mi-6-2.jpg',
                'ao-so-mi-6-3.jpg',
                'ao-so-mi-6-4.jpg',
                'ao-so-mi-6-5.jpg',
            ],
            19 => [
                'ao-khoac-1-2.jpg',
                'ao-khoac-1-3.jpg',
                'ao-khoac-1-4.jpg',
                'ao-khoac-1-5.jpg',
                'ao-khoac-1-6.jpg'
            ],
            20 => [
                'ao-khoac-2-2.jpg',
                'ao-khoac-2-3.jpg',
                'ao-khoac-2-4.jpg',
            ],
            21 => [
                'ao-khoac-3-2.jpg',
                'ao-khoac-3-3.jpg',
                'ao-khoac-3-4.jpg',
                'ao-khoac-3-5.jpg',
                'ao-khoac-3-6.jpg',
                'ao-khoac-3-7.jpg'
            ],
            22 => [
                'ao-khoac-4-2.jpg',
                'ao-khoac-4-3.jpg',
                'ao-khoac-4-4.jpg',
                'ao-khoac-4-5.jpg',
                'ao-khoac-4-6.jpg'
            ],
            23 => [
                'ao-khoac-5-2.jpg',
                'ao-khoac-5-3.jpg',
                'ao-khoac-5-4.jpg',
            ],
            24 => [
                'ao-khoac-6-2.jpg',
                'ao-khoac-6-3.jpg',
                'ao-khoac-6-4.jpg',
            ],
            25 => [
                'ao-hoodie-1-2.jpg',
                'ao-hoodie-1-3.jpg',
                'ao-hoodie-1-4.jpg',
                'ao-hoodie-1-5.jpg',
            ],
            26 => [
                'ao-hoodie-2-2.jpg',
                'ao-hoodie-2-3.jpg',
                'ao-hoodie-2-4.jpg',
                'ao-hoodie-2-5.jpg',
            ],
            27 => [
                'ao-hoodie-3-2.jpg',
                'ao-hoodie-3-3.jpg',
                'ao-hoodie-3-4.jpg',
            ],
            28 => [
                'ao-hoodie-4-2.jpg',
                'ao-hoodie-4-3.jpg',
                'ao-hoodie-4-4.jpg',
                'ao-hoodie-4-5.jpg',
            ],
            29 => [
                'ao-hoodie-5-2.jpg',
                'ao-hoodie-5-3.jpg',
                'ao-hoodie-5-4.jpg',
                'ao-hoodie-5-5.jpg',
            ],
            30 => [
                'ao-hoodie-6-2.jpg',
                'ao-hoodie-6-3.jpg',
                'ao-hoodie-6-4.jpg',
                'ao-hoodie-6-5.jpg',
            ],
            31 => [
                'quan-jean-1-2.jpg',
                'quan-jean-1-3.jpg',
                'quan-jean-1-4.jpg',
                'quan-jean-1-5.jpg',
            ],
            32 => [
                'quan-jean-2-2.jpg',
                'quan-jean-2-3.jpg',
                'quan-jean-2-4.jpg',
                'quan-jean-2-5.jpg',
            ],
            33 => [
                'quan-jean-3-2.jpg',
                'quan-jean-3-3.jpg',
                'quan-jean-3-4.jpg',
                'quan-jean-3-5.jpg',
            ],
            34 => [
                'quan-jean-4-2.jpg',
                'quan-jean-4-3.jpg',
                'quan-jean-4-4.jpg',
                'quan-jean-4-5.jpg',
            ],
            35 => [
                'quan-jean-5-2.jpg',
                'quan-jean-5-3.jpg',
                'quan-jean-5-4.jpg',
                'quan-jean-5-5.jpg',
            ],
            36 => [
                'quan-jean-6-2.jpg',
                'quan-jean-6-3.jpg',
                'quan-jean-6-4.jpg',
                'quan-jean-6-5.jpg',
            ],
            37 => [
                'quan-kaki-1-2.jpg',
                'quan-kaki-1-3.jpg',
                'quan-kaki-1-4.jpg',
                'quan-kaki-1-5.jpg',
            ],
            38 => [
                'quan-kaki-2-2.jpg',
                'quan-kaki-2-3.jpg',
                'quan-kaki-2-4.jpg',
                'quan-kaki-2-5.jpg',
            ],
            39 => [
                'quan-kaki-3-2.jpg',
                'quan-kaki-3-3.jpg',
                'quan-kaki-3-4.jpg',
                'quan-kaki-3-5.jpg',
            ],
            40 => [
                'quan-kaki-4-2.jpg',
                'quan-kaki-4-3.jpg',
                'quan-kaki-4-4.jpg',
                'quan-kaki-4-5.jpg',
            ],
            41 => [
                'quan-kaki-5-2.jpg',
                'quan-kaki-5-3.jpg',
                'quan-kaki-5-4.jpg',
            ],
            42 => [
                'quan-kaki-6-2.jpg',
                'quan-kaki-6-3.jpg',
                'quan-kaki-6-4.jpg',
                'quan-kaki-6-5.jpg',
            ],
            43 => [
                'quan-short-1-2.jpg',
                'quan-short-1-3.jpg',
                'quan-short-1-4.jpg',
                'quan-short-1-5.jpg',
            ],
            44 => [
                'quan-short-2-2.jpg',
                'quan-short-2-3.jpg',
                'quan-short-2-4.jpg',
                'quan-short-2-5.jpg',
            ],
            45 => [
                'quan-short-3-2.jpg',
                'quan-short-3-3.jpg',
                'quan-short-3-4.jpg',
                'quan-short-3-5.jpg',
            ],
            46 => [
                'quan-short-4-2.jpg',
                'quan-short-4-3.jpg',
                'quan-short-4-4.jpg',
                'quan-short-4-5.jpg',
            ],
            47 => [
                'quan-short-5-2.jpg',
                'quan-short-5-3.jpg',
                'quan-short-5-4.jpg',
                'quan-short-5-5.jpg',
            ],
            48 => [
                'quan-short-6-2.jpg',
                'quan-short-6-3.jpg',
                'quan-short-6-4.jpg',
                'quan-short-6-5.jpg',
            ],
            49 => [
                'ao-thun-nu-1-2.jpg',
                'ao-thun-nu-1-3.jpg',
                'ao-thun-nu-1-4.jpg',
                'ao-thun-nu-1-5.jpg',
            ],
            50 => [
                'ao-thun-nu-2-2.jpg',
                'ao-thun-nu-2-3.jpg',
                'ao-thun-nu-2-4.jpg',
            ],
            51 => [
                'ao-thun-nu-3-2.jpg',
                'ao-thun-nu-3-3.jpg',
                'ao-thun-nu-3-4.jpg',
            ],
            52 => [
                'ao-thun-nu-4-2.jpg',
                'ao-thun-nu-4-3.jpg',
                'ao-thun-nu-4-4.jpg',

            ],
            53 => [
                'ao-thun-nu-5-2.jpg',
                'ao-thun-nu-5-3.jpg',
                'ao-thun-nu-5-4.jpg',
            ],
            54 => [
                'ao-thun-nu-6-2.jpg',
                'ao-thun-nu-6-3.jpg',
                'ao-thun-nu-6-4.jpg',
            ],
            55 => [
                'ao-somi-nu-1-2.jpg',
                'ao-somi-nu-1-3.jpg',
                'ao-somi-nu-1-4.jpg',
            ],
            56 => [
                'ao-somi-nu-2-2.jpg',
                'ao-somi-nu-2-3.jpg',
                'ao-somi-nu-2-4.jpg',
            ],
            57 => [
                'ao-somi-nu-3-2.jpg',
                'ao-somi-nu-3-3.jpg',
                'ao-somi-nu-3-4.jpg',
            ],
            58 => [
                'ao-somi-nu-4-2.jpg',
                'ao-somi-nu-4-3.jpg',
                'ao-somi-nu-4-4.jpg',
            ],
            59 => [
                'ao-somi-nu-5-2.jpg',
                'ao-somi-nu-5-3.jpg',
                'ao-somi-nu-6-4.jpg',
            ],
            60 => [
                'ao-somi-nu-6-2.jpg',
                'ao-somi-nu-6-3.jpg',
                'ao-somi-nu-6-4.jpg',
            ],
            61 => [
                'ao-khoac-nu-1-2.jpg',
                'ao-khoac-nu-2-3.jpg',
                'ao-khoac-nu-3-4.jpg',
            ],
            62 => [
                'ao-khoac-nu-2-2.jpg',
                'ao-khoac-nu-2-3.jpg',
                'ao-khoac-nu-2-4.jpg',
            ],
            63 => [
                'ao-khoac-nu-3-2.jpg',
                'ao-khoac-nu-3-3.jpg',
                'ao-khoac-nu-3-4.jpg',
            ],
            64 => [
                'ao-khoac-nu-4-2.jpg',
                'ao-khoac-nu-4-3.jpg',
                'ao-khoac-nu-4-4.jpg',
            ],
            65 => [
                'ao-khoac-nu-5-2.jpg',
                'ao-khoac-nu-5-3.jpg',
                'ao-khoac-nu-5-4.jpg',
            ],
            66 => [
                'ao-khoac-nu-6-2.jpg',
                'ao-khoac-nu-6-3.jpg',
                'ao-khoac-nu-6-4.jpg',
            ],
            67 => [
                'hoodie-nu-1-2.jpg',
                'hoodie-nu-1-3.jpg',
                'hoodie-nu-1-4.jpg',
            ],
            68 => [
                'hoodie-nu-2-2.jpg',
                'hoodie-nu-2-3.jpg',
                'hoodie-nu-2-4.jpg',
            ],
            69 => [
                'hoodie-nu-3-2.jpg',
                'hoodie-nu-3-3.jpg',
                'hoodie-nu-3-4.jpg',
            ],
            70 => [
                'hoodie-nu-4-2.jpg',
                'hoodie-nu-4-3.jpg',
                'hoodie-nu-4-4.jpg',
            ],
            71 => [
                'quan-jean-nu-1-2.jpg',
                'quan-jean-nu-1-3.jpg',
                'quan-jean-nu-1-4.jpg',
            ],
            72 => [
                'quan-jean-nu-2-2.jpg',
                'quan-jean-nu-2-3.jpg',
                'quan-jean-nu-2-4.jpg',
            ],
            73 => [
                'quan-jean-nu-3-2.jpg',
                'quan-jean-nu-3-3.jpg',
                'quan-jean-nu-3-4.jpg',
            ],
            74 => [
                'quan-jean-nu-4-2.jpg',
                'quan-jean-nu-4-3.jpg',
                'quan-jean-nu-4-4.jpg',
            ],
            75 => [
                'quan-jean-nu-5-2.jpg',
                'quan-jean-nu-5-3.jpg',
                'quan-jean-nu-5-4.jpg',
            ],
            76 => [
                'quan-jean-nu-6-2.jpg',
                'quan-jean-nu-6-3.jpg',
                'quan-jean-nu-6-4.jpg',
            ],
            77 => [
                'quan-kaki-nu-1-2.jpg',
                'quan-kaki-nu-1-3.jpg',
                'quan-kaki-nu-1-4.jpg',
            ],
            78 => [
                'quan-kaki-nu-2-2.jpg',
                'quan-kaki-nu-2-3.jpg',
                'quan-kaki-nu-2-4.jpg',
            ],
            79 => [
                'quan-kaki-nu-3-2.jpg',
                'quan-kaki-nu-3-3.jpg',
                'quan-kaki-nu-3-4.jpg',
            ],
            80 => [
                'quan-kaki-nu-4-2.jpg',
                'quan-kaki-nu-4-3.jpg',
                'quan-kaki-nu-4-4.jpg',
            ],
            81 => [
                'quan-kaki-nu-5-2.jpg',
                'quan-kaki-nu-5-3.jpg',
                'quan-kaki-nu-5-4.jpg',
            ],
            82 => [
                'quan-kaki-nu-6-2.jpg',
                'quan-kaki-nu-6-3.jpg',
                'quan-kaki-nu-6-4.jpg',
            ],
            83 => [
                'quan-short-nu-1-2.jpg',
                'quan-short-nu-1-3.jpg',
                'quan-short-nu-1-4.jpg',
            ],
            84 => [
                'quan-short-nu-2-2.jpg',
                'quan-short-nu-2-3.jpg',
                'quan-short-nu-2-4.jpg',
            ],
            85 => [
                'quan-short-nu-3-2.jpg',
                'quan-short-nu-3-3.jpg',
                'quan-short-nu-3-4.jpg',
            ],
            86 => [
                'quan-short-nu-4-2.jpg',
                'quan-short-nu-4-3.jpg',
                'quan-short-nu-5-4.jpg',
            ],
            87 => [
                'quan-short-nu-5-2.jpg',
                'quan-short-nu-5-3.jpg',
                'quan-short-nu-5-4.jpg',
            ],
            88 => [
                'quan-short-nu-6-2.jpg',
                'quan-short-nu-6-3.jpg',
                'quan-short-nu-6-4.jpg',
            ],
            89 => [
                'dam-nu-1-2.jpg',
                'dam-nu-1-3.jpg',
                'dam-nu-1-4.jpg',
            ],
            90 => [
                'dam-nu-2-2.jpg',
                'dam-nu-2-3.jpg',
                'dam-nu-2-4.jpg',
            ],
            91 => [
                'dam-nu-3-2.jpg',
                'dam-nu-3-3.jpg',
                'dam-nu-3-4.jpg',
            ],
            92 => [
                'dam-nu-4-2.jpg',
                'dam-nu-4-3.jpg',
                'dam-nu-4-4.jpg',
            ],
            93 => [
                'dam-nu-5-2.jpg',
                'dam-nu-5-3.jpg',
                'dam-nu-5-4.jpg',
            ],
            94 => [
                'dam-nu-6-2.jpg',
                'dam-nu-6-3.jpg',
                'dam-nu-6-4.jpg',
            ],
            95 => [
                'chan-vay-nu-1-2.jpg',
                'chan-vay-nu-1-2.jpg',
                'chan-vay-nu-1-2.jpg',
            ],
            96 => [
                'chan-vay-nu-1-2.jpg',
                'chan-vay-nu-1-2.jpg',
                'chan-vay-nu-1-2.jpg',
            ],
            97 => [
                'chan-vay-nu-3-2.jpg',
                'chan-vay-nu-3-2.jpg',
                'chan-vay-nu-3-2.jpg',
            ],
            98 => [
                'chan-vay-nu-4-2.jpg',
                'chan-vay-nu-4-2.jpg',
                'chan-vay-nu-4-2.jpg',
            ],
            99 => [
                'chan-vay-nu-5-2.jpg',
                'chan-vay-nu-5-2.jpg',
                'chan-vay-nu-5-2.jpg',
            ],
            100 => [
                'chan-vay-nu-6-2.jpg',
                'chan-vay-nu-6-2.jpg',
                'chan-vay-nu-6-2.jpg',
            ],
            101 => [
                'non-luoi-trai-nam-1-2.jpg',
                'non-luoi-trai-nam-1-3.jpg',
                'non-luoi-trai-nam-1-4.jpg',
            ],
            102 => [
                'non-luoi-trai-nam-2-2.jpg',
                'non-luoi-trai-nam-2-3.jpg',
            ],
            103 => [
                'non-luoi-trai-nam-3-2.jpg',
                'non-luoi-trai-nam-3-3.jpg',
                'non-luoi-trai-nam-3-4.jpg',
            ],
            104 => [
                'bang-do-vai-1-2.jpg',
                'bang-do-vai-1-3.jpg',
                'bang-do-vai-1-4.jpg',
            ],
            105 => [
                'non-bucket-unisex-1-2.jpg',
                'non-bucket-unisex-1-3.jpg',
                'non-bucket-unisex-1-4.jpg',
            ],
            106 => [
                'non-luoi-trai-nu-1-2.jpg',
                'non-luoi-trai-nu-1-3.jpg',
                'non-luoi-trai-nu-1-4.jpg',
            ],
            107 => [
                'tui-tote-unisex-1-2.jpg',
                'tui-tote-unisex-1-3.jpg',
                'tui-tote-unisex-1-4.jpg',
            ],
            108 => [
                'tui-deo-ban-nguyet-nu-1-2.jpg',
                'tui-deo-ban-nguyet-nu-1-3.jpg',
                'tui-deo-ban-nguyet-nu-1-4.jpg'
            ],
            109 => [
                'tui-tote-unisex-ke-soc-1-2.jpg',
                'tui-tote-unisex-ke-soc-1-3.jpg',
                'tui-tote-unisex-ke-soc-1-4.jpg',
            ],
            110 => [
                'tui-deo-cheo-2-2.jpg',
                'tui-deo-cheo-2-3.jpg',
                'tui-deo-cheo-2-4.jpg',
            ],
            111 => [
                'balo-canvas-tui-hop-1-2.jpg',
                'balo-canvas-tui-hop-1-3.jpg',
                'balo-canvas-tui-hop-1-4.jpg',
            ],
            112 => [
                'tui-deo-cheo-unisex-theu-nhan-1-2.jpg',
                'tui-deo-cheo-unisex-theu-nhan-1-3.jpg',
                'tui-deo-cheo-unisex-theu-nhan-1-4.jpg',
            ],




        ];

        foreach ($products as $productId => $images) {
            foreach ($images as $image) {
                ProductImage::create([
                    'img' => $image,
                    'product_id' => $productId
                ]);
            }
        }
    }
}
