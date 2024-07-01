<?php

namespace App\Repository\Eloquent;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class CartRepository
 * @package App\Repositories\Eloquent
 */
class CartRepository extends BaseRepository
{
    /**
     * CartRepository constructor.
     *
     * @param Cart $Cart
     */
    public function __construct(Cart $cart)
    {
        parent::__construct($cart);
    }

    public function getUserProducts()
    {
        return Cart::where('user_id', Auth::id())
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('products.*', 'carts.quantity as cart_quantity')
            ->get();
    }
    public function getCart()
    {
        return DB::table('carts')
        ->join('products', 'carts.product_id', '=', 'products.id')
        ->join('users', 'carts.user_id', '=', 'users.id')
        ->join('products_color', 'carts.product_color_id', '=', 'products_color.id') // Tham chiếu product_color_id với products_color.id
        ->join('colors', 'products_color.color_id', '=', 'colors.id') // Lấy tên màu dựa trên products_color.color_id
        ->join('products_size', 'carts.product_size_id', '=', 'products_size.id') // Tham chiếu product_size_id với products_size.id
        ->join('sizes', 'products_size.size_id', '=', 'sizes.id') // Lấy tên kích thước dựa trên products_size.size_id
        ->select(
            'products.img as product_image',
            'products.name as product_name',
            'products.price_sell as product_price',
            'carts.quantity as cart_quantity',
            'products.id as product_id',
            'users.name as user_name',
            'colors.name as color_name',
            'sizes.name as size_name',
            'carts.id as cart_id'
        )
        ->where('carts.user_id', Auth::id())
        ->whereNull('carts.deleted_at')
        ->get();
    }
}

?>
