<?php

namespace App\Http\Services\User;

use Illuminate\Support\Facades\Session;
use App\Models\Product;

class WishlistService
{
    const WISHLIST_KEY = 'wishlist';

    public function getWishlistProducts()
    {
        $wishlist = $this->getWishlist();
        return Product::whereIn('id', $wishlist)->get();
    }

    public function getWishlist()
    {
        return Session::get(self::WISHLIST_KEY, []);
    }

    public function addToWishlist($productId)
    {
        $wishlist = $this->getWishlist();
        if (!in_array($productId, $wishlist)) {
            $wishlist[] = $productId;
            Session::put(self::WISHLIST_KEY, $wishlist);
        }
    }

    public function removeFromWishlist($productId)
    {
        $wishlist = $this->getWishlist();
        if (($key = array_search($productId, $wishlist)) !== false) {
            unset($wishlist[$key]);
            Session::put(self::WISHLIST_KEY, array_values($wishlist));
        }
    }
}
