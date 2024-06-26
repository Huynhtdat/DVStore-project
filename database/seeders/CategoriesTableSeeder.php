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
                'status' => 1,
            ],
            [
                'name' => 'Thời Trang Nữ',
                'parent_id' => 0,
                'slug' => 'thoi-trang-nu',
                'status' => 1,
            ],
            [
                'name' => 'Phụ Kiện',
                'parent_id' => 0,
                'slug' => 'phu-kien',
                'status' => 1,
            ],
            [
                'name' => 'Áo Polo Nam',
                'parent_id' => 1,
                'slug' => 'ao-polo-nam',
                'status' => 1,
            ],
            [
                'name' => 'Áo Thun Nam',
                'parent_id' => 1,
                'slug' => 'ao-thun-nam',
                'status' => 1,
            ],
            [
                'name' => 'Áo Sơ Mi Nam',
                'parent_id' => 1,
                'slug' => 'ao-so-mi-nam',
                'status' => 1,
            ],
            [
                'name' => 'Áo Khoác Nam',
                'parent_id' => 1,
                'slug' => 'ao-khoac-nam',
                'status' => 1,
            ],
            [
                'name' => 'Áo Hoodie - Sweater Nam',
                'parent_id' => 1,
                'slug' => 'ao-hoodie-nam',
                'status' => 1,
            ],
            [
                'name' => 'Quần Jean Nam',
                'parent_id' => 1,
                'slug' => 'quan-jean-nam',
                'status' => 1,
            ],
            [
                'name' => 'Quần Kaki Nam',
                'parent_id' => 1,
                'slug' => 'quan-kaki-nam',
                'status' => 1,
            ],
            [
                'name' => 'Quần Short Nam',
                'parent_id' => 1,
                'slug' => 'quan-short-nam',
                'status' => 1,
            ],
            [
                'name' => 'Áo Thun Nữ',
                'parent_id' => 2,
                'slug' => 'ao-thun-nu',
                'status' => 1,
            ],
            [
                'name' => 'Áo Sơ Mi Nữ',
                'parent_id' => 2,
                'slug' => 'ao-so-mi-nu',
                'status' => 1,
            ],
            [
                'name' => 'Áo Khoác Nữ',
                'parent_id' => 2,
                'slug' => 'ao-khoac-nu',
                'status' => 1,
            ],
            [
                'name' => 'Áo Hoodie - Sweater Nữ',
                'parent_id' => 2,
                'slug' => 'ao-hoodie-nu',
                'status' => 1,
            ],
            [
                'name' => 'Quần Jean Nữ',
                'parent_id' => 2,
                'slug' => 'quan-jean-nu',
                'status' => 1,
            ],
            [
                'name' => 'Quần Kaki Nữ',
                'parent_id' => 2,
                'slug' => 'quan-kaki-nu',
                'status' => 1,
            ],
            [
                'name' => 'Quần Short Nữ',
                'parent_id' => 2,
                'slug' => 'quan-short-nu',
                'status' => 1,
            ],
            [
                'name' => 'Đầm Nữ',
                'parent_id' => 2,
                'slug' => 'dam-nu',
                'status' => 1,
            ],
            [
                'name' => 'Chân Váy',
                'parent_id' => 2,
                'slug' => 'chan-vay',
                'status' => 1,
            ],
            [
                'name' => 'Nón - Băng Đô',
                'parent_id' => 3,
                'slug' => 'non-bangdo',
                'status' => 1,
            ],
            [
                'name' => 'Túi - Ví - Balo',
                'parent_id' => 3,
                'slug' => 'tui-vi-balo',
                'status' => 1,
            ],
            [
                'name' => 'Khăn',
                'parent_id' => 3,
                'slug' => 'khan',
                'status' => 1,
            ],
            [
                'name' => 'Thắt Lưng',
                'parent_id' => 3,
                'slug' => 'that-lưng',
                'status' => 1,
            ],
            [
                'name' => 'Vớ - Tất',
                'parent_id' => 3,
                'slug' => 'vo-tat',
                'status' => 1,
            ],
            [
                'name' => 'Giày - Dép',
                'parent_id' => 3,
                'slug' => 'giay-dep',
                'status' => 1,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
