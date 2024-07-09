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
        $wishlistItems = $this->wishlistService->getWishlistProducts();
        return view('user.wishlist', ['wishlistItems' => $wishlistItems]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);

        $productId = $request->input('product_id');
        $this->wishlistService->addToWishlist($productId);

        $wishlistItems = $this->wishlistService->getWishlistProducts();

        return view('user.wishlist', ['wishlistItems' => $wishlistItems])
            ->with('success', 'Product added to wishlist successfully.');
    }


    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);

        $productId = $request->input('product_id');
        $this->wishlistService->removeFromWishlist($productId);

        $wishlistItems = $this->wishlistService->getWishlistProducts();

        return view('user.wishlist', ['wishlistItems' => $wishlistItems])
            ->with('success', 'Product removed from wishlist successfully.');
    }
}
