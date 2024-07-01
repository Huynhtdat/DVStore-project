<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\User\WishlistService;

class WishlistController extends Controller
{
    protected $wishlistService;

    public function __construct(WishlistService $wishlistService)
    {
        $this->wishlistService = $wishlistService;
    }

    public function index()
    {
        $products = $this->wishlistService->getWishlistProducts();
        return view('user.wishlist', compact('products'));
    }

    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $this->wishlistService->addToWishlist($productId);

        return response()->json(['message' => 'Product added to wishlist']);
    }

    public function remove(Request $request)
    {
        $productId = $request->input('product_id');
        $this->wishlistService->removeFromWishlist($productId);

        return response()->json(['message' => 'Product removed from wishlist']);
    }
}
