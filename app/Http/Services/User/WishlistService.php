<?php

namespace App\Http\Services\User;

use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use App\Models\Product;

class WishlistService
{
    public function getWishlistProducts()
    {
        $userId = Auth::id();
        $wishlist = Wishlist::where('user_id', $userId)->pluck('product_id')->toArray();
        return Product::whereIn('id', $wishlist)->get();
    }

    public function getWishlist()
    {
        $userId = Auth::id();
        return Wishlist::where('user_id', $userId)->pluck('product_id')->toArray();
    }

    public function addToWishlist($productId)
    {
        $userId = Auth::id();
        if (!Wishlist::where('user_id', $userId)->where('product_id', $productId)->exists()) {
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $productId,
            ]);
        }
    }

    public function removeFromWishlist($productId)
    {
        $userId = Auth::id();
        Wishlist::where('user_id', $userId)->where('product_id', $productId)->delete();
    }
}
