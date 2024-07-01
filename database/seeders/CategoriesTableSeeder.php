<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Thời Trang Nam',
                'parent_id' => 0,
                'slug' => 'thơi-trang-nam',
            ],
            [
                'name' => 'Thời Trang Nữ',
                'parent_id' => 0,
                'slug' => 'thoi-trang-nu',
            ],
            [
                'name' => 'Phụ Kiện',
                'parent_id' => 0,
                'slug' => 'phu-kien',
            ],
            [
                'name' => 'Áo Polo Nam',
                'parent_id' => 1,
                'slug' => 'ao-polo-nam',
            ],
            [
                'name' => 'Áo Thun Nam',
                'parent_id' => 1,
                'slug' => 'ao-thun-nam',
            ],
            [
                'name' => 'Áo Sơ Mi Nam',
                'parent_id' => 1,
                'slug' => 'ao-so-mi-nam',
            ],
            [
                'name' => 'Áo Khoác Nam',
                'parent_id' => 1,
                'slug' => 'ao-khoac-nam',
            ],
            [
                'name' => 'Áo Hoodie - Sweater Nam',
                'parent_id' => 1,
                'slug' => 'ao-hoodie-nam',
            ],
            [
                'name' => 'Quần Jean Nam',
                'parent_id' => 1,
                'slug' => 'quan-jean-nam',
            ],
            [
                'name' => 'Quần Kaki Nam',
                'parent_id' => 1,
                'slug' => 'quan-kaki-nam',
            ],
            [
                'name' => 'Quần Short Nam',
                'parent_id' => 1,
                'slug' => 'quan-short-nam',
            ],
            [
                'name' => 'Áo Thun Nữ',
                'parent_id' => 2,
                'slug' => 'ao-thun-nu',
            ],
            [
                'name' => 'Áo Sơ Mi Nữ',
                'parent_id' => 2,
                'slug' => 'ao-so-mi-nu',
            ],
            [
                'name' => 'Áo Khoác Nữ',
                'parent_id' => 2,
                'slug' => 'ao-khoac-nu',
            ],
            [
                'name' => 'Áo Hoodie - Sweater Nữ',
                'parent_id' => 2,
                'slug' => 'ao-hoodie-nu',
            ],
            [
                'name' => 'Quần Jean Nữ',
                'parent_id' => 2,
                'slug' => 'quan-jean-nu',
            ],
            [
                'name' => 'Quần Kaki Nữ',
                'parent_id' => 2,
                'slug' => 'quan-kaki-nu',
            ],
            [
                'name' => 'Quần Short Nữ',
                'parent_id' => 2,
                'slug' => 'quan-short-nu',
            ],
            [
                'name' => 'Đầm Nữ',
                'parent_id' => 2,
                'slug' => 'dam-nu',
            ],
            [
                'name' => 'Chân Váy',
                'parent_id' => 2,
                'slug' => 'chan-vay',
            ],
            [
                'name' => 'Nón - Băng Đô',
                'parent_id' => 3,
                'slug' => 'non-bangdo',
            ],
            [
                'name' => 'Túi - Ví - Balo',
                'parent_id' => 3,
                'slug' => 'tui-vi-balo',
            ],
            [
                'name' => 'Khăn',
                'parent_id' => 3,
                'slug' => 'khan',
            ],
            [
                'name' => 'Thắt Lưng',
                'parent_id' => 3,
                'slug' => 'that-lưng',
            ],
            [
                'name' => 'Vớ - Tất',
                'parent_id' => 3,
                'slug' => 'vo-tat',
            ],
            [
                'name' => 'Giày - Dép',
                'parent_id' => 3,
                'slug' => 'giay-dep',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
