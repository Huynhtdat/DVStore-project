<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

if (!function_exists('category_header')) {
    function category_header()
    {
        return DB::table('categories')->where('parent_id', 0)->get();
    }
}

if (!function_exists('setting_website')) {
    function setting_website()
    {
        return DB::table('setting')->first();
    }
}

if (!function_exists('cart_header')) {
    function cart_header()
    {
        return DB::table('carts')->first();

    }
}
?>
