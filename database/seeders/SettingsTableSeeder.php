<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting')->insert([
            [
                'logo' => '1717925538.png',
                'name' => 'DVSTORE',
                'email' => 'dvstore2707@gmail.com',
                'address' => 'Km4 Thôn Hùng Nghĩa, xã Phổ Phong, Thị xã Đức Phổ, Tỉnh Quảng Ngãi',
                'phone_number' => '0336410420',
                'maintenance' => 0,
                'notification' => 'Welcome to our website!',
                'introduction' => 'We are a company that values excellence.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
